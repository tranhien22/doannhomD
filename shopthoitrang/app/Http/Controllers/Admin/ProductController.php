<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function indexProduct() {
        $products = Product::getProductsWithPagination(2);
        $category = Category::all();
        $manufacturer = Manufacturer::getAllManufacturers();
        return view('admin.product.listproduct', [
            'products' => $products,
            'categorys' => $category,
            'manufacturers' => $manufacturer,
        ]);
    }    

    public function indexAddProduct(){
        $category = Category::all();
        $manufacturer = Manufacturer::getAllManufacturers();
        return view('admin.product.addproduct', [
            'categorys' => $category,
            'manufacturers' => $manufacturer
        ]);
    }
    
    public function addProduct(Request $request){
        // Validate the request
        $validator = Validator::make($request->all(), Product::$rules, Product::$messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Handle image upload
        if($request->hasFile('image_address_product')) {
            $file = $request->file('image_address_product');
            $ex = $file->getClientOriginalExtension();
            $filename = time().'.'.$ex;
            $file->move('uploads/productimage/',$filename);
            $data['image_address_product'] = $filename;
        }

        try {
            // Create new product
            Product::createProduct([
                'selected_category' => $data['id_category'],
                'selected_manufacturer' => $data['id_manufacturer'],
                'name_product' => $data['name_product'],
                'quantity_product' => $data['quantity_product'],
                'price_product' => $data['price_product'],
                'image_address_product' => $data['image_address_product'],
                'describe_product' => $data['describe_product'],
                'specifications' => $data['specifications'] ?? null,
                'sizes' => $data['sizes'] ?? null,
                'colors' => $data['colors'] ?? null,
            ]);

            return redirect()->route('product.listproduct')
                ->with('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $e) {
            // If image was uploaded but product creation failed, delete the image
            if (isset($data['image_address_product'])) {
                $image_path = 'uploads/productimage/' . $data['image_address_product'];
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi thêm sản phẩm: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function deleteProduct(Request $request){
        try {
            $product = Product::findProductById($request->get('id'));
            
            // Delete the product image if it exists
            if ($product && $product->image_address_product) {
                $image_path = 'uploads/productimage/' . $product->image_address_product;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            Product::destroy($request->get('id'));
            return redirect()->route('product.listproduct')
                ->with('success', 'Xóa sản phẩm thành công');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi xóa sản phẩm: ' . $e->getMessage());
        }
    }

    public function indexUpdateProduct(Request $request){
        $product = Product::findProductById($request->get('id'));
        $category = Category::all();
        $manufacturer = Manufacturer::getAllManufacturers();
        if (!$product) {
            // Nếu không tìm thấy sản phẩm, trả về view với thông báo lỗi và không truyền biến $products
            return view('admin.product.updateproduct', [
                'products' => null,
                'categorys' => $category,
                'manufacturers' => $manufacturer,
                'notfound' => true
            ]);
        }
        return view('admin.product.updateproduct', [
            'products' => $product,
            'categorys' => $category,
            'manufacturers' => $manufacturer
        ]);
    }
    
    public function updateProduct(Request $request){
        // Sử dụng rules giống như khi thêm mới
        $validator = Validator::make($request->all(), Product::$rules, Product::$messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        
        try {
            $product = Product::findProductById($data['id']);
            if (!$product) {
                // Nếu không tìm thấy sản phẩm, trả về lại trang cập nhật với thông báo lỗi
                return redirect()->back()
                    ->with('error', 'Không tìm thấy sản phẩm để cập nhật. Có thể sản phẩm đã bị xóa ở nơi khác.')
                    ->withInput();
            }

            if($request->hasFile('image_address_product')) {
                // Xóa ảnh cũ
                $image_cu = 'uploads/productimage/' . $product->image_address_product;
                if(File::exists($image_cu)) {
                    File::delete($image_cu);
                }
                
                // Upload ảnh mới
                $file = $request->file('image_address_product');
                $ex = $file->getClientOriginalExtension();
                $filename = time().'.'.$ex;
                $file->move('uploads/productimage/',$filename);
                $data['image_address_product'] = $filename;
            }

            // Update product
            Product::updateProductById($data['id'], [
                'selected_category' => $data['id_category'],
                'selected_manufacturer' => $data['id_manufacturer'],
                'name_product' => $data['name_product'],
                'quantity_product' => $data['quantity_product'],
                'price_product' => $data['price_product'],
                'describe_product' => $data['describe_product'],
                'specifications' => $data['specifications'] ?? null,
                'sizes' => $data['sizes'] ?? null,
                'colors' => $data['colors'] ?? null,
                'image_address_product' => $data['image_address_product'] ?? $product->image_address_product,
            ]);

            return redirect()->route('product.listproduct')
                ->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $e) {
            // Nếu upload ảnh mới mà lỗi thì xóa ảnh mới
            if (isset($data['image_address_product']) && $request->hasFile('image_address_product')) {
                $image_path = 'uploads/productimage/' . $data['image_address_product'];
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi cập nhật sản phẩm: ' . $e->getMessage())
                ->withInput();
        }
    }
}