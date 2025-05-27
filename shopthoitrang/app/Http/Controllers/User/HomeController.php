<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;

class HomeController extends Controller
{
    public function indexHome(Request $request)
    {
        $page = $request->query('page', 1);

        if (!is_numeric($page) || $page < 1) {
            return redirect()->route('home.index')->with('error', 'Tham số trang không hợp lệ.');
        }

        $product = Product::getHomePageProducts(6);

        // Check if the requested page is valid within the paginated results
        if ($product->currentPage() > $product->lastPage() && $product->lastPage() > 0) {
             return redirect()->route('home.index')->with('error', 'Tham số trang không hợp lệ.');
        }

        $get6newproduct = Product::getLatestProducts(6);
        $category = Category::all();
        $manufacturer = Manufacturer::getAllManufacturers();
        $productsWithCategorys = Product::getProductsWithCategories();
        $productsWithManufacturers = Product::getProductsWithManufacturers();

        return view('user.home', [
            'products' => $product,
            'get6newproducts' => $get6newproduct,
            'categorys' => $category,
            'manufacturers' => $manufacturer,
            'productsWithCategorys' => $productsWithCategorys,
            'productsWithManufacturers' => $productsWithManufacturers
        ]);
    }

    public function indexDetailProduct(Request $request)
    {
        $product = Product::findProductById($request->get('id'));
        
        if (!$product) {
            return redirect()->route('home.index')->with('error', 'Không tìm thấy sản phẩm');
        }

        $specificationArray = $product->getSpecificationsArray();
        $colors = $product->getColorsArray();
        $sizes = $product->getSizesArray();
        $manufacturer = Manufacturer::findManufacturerById($product->id_manufacturer);

        return view('user.detailproduct', [
            'specifications' => $specificationArray,
            'product' => $product,
            'colors' => $colors,
            'sizes' => $sizes,
            'manufacturer' => $manufacturer
        ]);
    }

    public function showProductDetail($id)
    {
        $product = Product::getProductDetail($id);
        
        if (!$product) {
            return redirect()->route('home.index')->with('error', 'Không tìm thấy sản phẩm');
        }

        $colors = $product->getColorsArray();
        $sizes = $product->getSizesArray();
        $specifications = $product->getSpecificationsArray();

        return view('user.detailproduct', compact('product', 'colors', 'sizes', 'specifications'));
    }
}