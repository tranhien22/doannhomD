<?php 
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Models\Product;

class ManufacturerControllerUser extends Controller
{
    public function indexmanufacture()
    {
        $manufacturers = Manufacturer::all();
        return view('user.manufacturer', compact('manufacturers'));
    }

    public function showProductsByManufacturer($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);

        $page = request()->query('page', 1);

        if (!is_numeric($page) || $page < 1) {
            return redirect()->route('manufacturer.products', ['id' => $id])->with('error', 'Tham số trang không hợp lệ.');
        }

        $products = Product::where('id_manufacturer', $id)->paginate(6);

        // Check if the requested page is valid within the paginated results
        if ($products->currentPage() > $products->lastPage() && $products->lastPage() > 0) {
             return redirect()->route('manufacturer.products', ['id' => $id])->with('error', 'Tham số trang không hợp lệ.');
        }

        return view('user.products_by_manufacturer', [
            'manufacturer' => $manufacturer,
            'products' => $products
        ]);
    }
}
