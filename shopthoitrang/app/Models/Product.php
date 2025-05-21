<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_product';

    protected $fillable = [
        'id_category',
        'id_manufacturer',
        'name_product',
        'quantity_product',
        'price_product',
        'image_address_product',
        'describe_product',
        'specifications',
        'sizes',
        'colors',
        'purchased' 
    ];

    // Validation rules
    public static $rules = [
        'name_product' => 'required|max:100',
        'quantity_product' => 'required|integer|min:0',
        'price_product' => 'required|numeric|min:0',
        'sizes' => ['required', 'regex:/^[a-zA-Z0-9\s,]{1,10}$/', 'max:10'],
        'image_address_product' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'describe_product' => 'required|max:500',
        'id_category' => 'required|exists:categories,id_category',
        'id_manufacturer' => 'required|exists:manufacturers,id_manufacturer',
        'specifications' => 'nullable|max:500',
        'colors' => 'nullable|string'
    ];

    // Custom error messages
    public static $messages = [
        'name_product.required' => 'Tên sản phẩm không được để trống',
        'name_product.max' => 'Bạn đã nhập quá 100 ký tự',
        'quantity_product.required' => 'Số lượng không được để trống',
        'quantity_product.integer' => 'Yêu cầu nhập trường chỉ nhập ký tự số nguyên',
        'quantity_product.min' => 'Số lượng phải lớn hơn hoặc bằng 0',
        'price_product.required' => 'Giá không được để trống',
        'price_product.numeric' => 'Trường chữ nhập ký tự số yêu cầu nhập lại',
        'price_product.min' => 'Giá phải lớn hơn hoặc bằng 0',
        'sizes.required' => 'Kích cỡ không được để trống',
        'sizes.regex' => 'Bạn đã nhập sai ký tự ngoài số và chữ yêu cầu nhập lại',
        'sizes.max' => 'Kích cỡ không được quá 10 ký tự',
        'image_address_product.required' => 'Ảnh sản phẩm không được để trống',
        'image_address_product.image' => 'File phải là hình ảnh',
        'image_address_product.mimes' => 'Định dạng ảnh phải là: jpeg, png, jpg, gif',
        'image_address_product.max' => 'Kích thước ảnh không được vượt quá 2MB',
        'describe_product.required' => 'Mô tả không được để trống',
        'describe_product.max' => 'Bạn đã nhập quá ký tự yêu cầu chỉ nhập không quá 500 ký tự',
        'id_category.required' => 'Danh mục không được để trống',
        'id_category.exists' => 'Danh mục không tồn tại',
        'id_manufacturer.required' => 'Nhà sản xuất không được để trống',
        'id_manufacturer.exists' => 'Nhà sản xuất không tồn tại'
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'id_manufacturer');
    }

    // Query Methods
    public static function getProductsWithPagination($perPage = 2)
    {
        return self::paginate($perPage);
    }

    public static function searchProducts($keyword, $perPage = 12)
    {
        return self::where('name_product', 'LIKE', '%' . $keyword . '%')
                   ->paginate($perPage);
    }

    public static function filterProducts($filters, $perPage = 12)
    {
        $query = self::query();

        if (!empty($filters['keyword'])) {
            $query->where('name_product', 'like', '%' . $filters['keyword'] . '%');
        }

        if (!empty($filters['category'])) {
            $query->where('id_category', $filters['category']);
        }

        if (!empty($filters['manufacturer'])) {
            $query->where('id_manufacturer', $filters['manufacturer']);
        }

        if (!empty($filters['price_min'])) {
            $query->where('price_product', '>=', $filters['price_min']);
        }

        if (!empty($filters['price_max'])) {
            $query->where('price_product', '<=', $filters['price_max']);
        }

        if (!empty($filters['purchased_min'])) {
            $query->where('purchased', '>=', $filters['purchased_min']);
        }

        if (!empty($filters['purchased_max'])) {
            $query->where('purchased', '<=', $filters['purchased_max']);
        }

        // Sort products
        switch ($filters['sort'] ?? 'newest') {
            case 'price_asc':
                $query->orderBy('price_product', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price_product', 'desc');
                break;
            case 'purchased':
                $query->orderBy('purchased', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query->paginate($perPage);
    }

    public static function getProductsByManufacturer($manufacturerId, $perPage = 12)
    {
        return self::where('id_manufacturer', $manufacturerId)->paginate($perPage);
    }

    public static function findProductById($id)
    {
        return self::where('id_product', $id)->first();
    }

    public static function createProduct($data)
    {
        return self::create([
            'id_category' => $data['selected_category'],
            'id_manufacturer' => $data['selected_manufacturer'], 
            'name_product' => $data['name_product'],
            'quantity_product' => $data['quantity_product'], 
            'price_product' => $data['price_product'],
            'image_address_product' => $data['image_address_product'], 
            'describe_product' => $data['describe_product'],
            'specifications' => $data['specifications'],
            'sizes' => $data['sizes'] ?? null,
            'colors' => $data['colors'] ?? null,
        ]);
    }

    public static function updateProductById($id, $data)
    {
        $product = self::findProductById($id);
        if ($product) {
            $product->id_category = $data['selected_category'];
            $product->id_manufacturer = $data['selected_manufacturer'];
            $product->name_product = $data['name_product'];
            $product->quantity_product = $data['quantity_product'];
            $product->price_product = $data['price_product'];
            $product->describe_product = $data['describe_product'];
            $product->specifications = $data['specifications'];
            $product->sizes = $data['sizes'] ?? $product->sizes;
            $product->colors = $data['colors'] ?? $product->colors;
            
            if (isset($data['image_address_product'])) {
                $product->image_address_product = $data['image_address_product'];
            }
            
            $product->save();
            return $product;
        }
        return null;
    }

    // New methods for HomeController
    public static function getHomePageProducts($perPage = 6)
    {
        return self::paginate($perPage);
    }

    public static function getLatestProducts($limit = 6)
    {
        return self::orderBy('created_at', 'desc')
                   ->take($limit)
                   ->get();
    }

    public static function getProductsWithCategories()
    {
        return self::select('products.*', 'categories.name_category')
                   ->leftJoin('categories', 'products.id_category', '=', 'categories.id_category')
                   ->get();
    }

    public static function getProductsWithManufacturers()
    {
        return self::select('products.*', 'manufacturers.name_manufacturer')
                   ->leftJoin('manufacturers', 'products.id_manufacturer', '=', 'manufacturers.id_manufacturer')
                   ->get();
    }

    public static function getProductDetail($id)
    {
        return self::find($id);
    }

    public function getSpecificationsArray()
    {
        return explode(';', $this->specifications);
    }

    public function getColorsArray()
    {
        return explode(',', $this->colors);
    }

    public function getSizesArray()
    {
        return explode(',', $this->sizes);
    }
}