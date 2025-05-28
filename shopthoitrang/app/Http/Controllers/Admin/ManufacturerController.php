<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    public function indexManufacturer(Request $request){
        try {
            $perPage = 2;
            $page = $request->get('page', 1);
            
            // Validate page parameter
            if (!is_numeric($page) || $page < 1) {
                return redirect()->route('manufacturer.listmanufacturer')
                    ->with('error', 'Trang không hợp lệ.');
            }

            $manufacturers = Manufacturer::getManufacturersWithPagination($perPage);
            
            // Check if requested page exists
            if ($page > $manufacturers->lastPage()) {
                return redirect()->route('manufacturer.listmanufacturer', ['page' => $manufacturers->lastPage()])
                    ->with('error', 'Trang không tồn tại.');
            }

            return view('admin.manufacturer.listManufacturer', ['manufacturers' => $manufacturers]);
        } catch (\Exception $e) {
            return redirect()->route('manufacturer.listmanufacturer')
                ->with('error', 'Có lỗi xảy ra khi tải danh sách hãng sản xuất.');
        }
    }    

    public function indexAddManufacturer(){
        return view('admin.manufacturer.addmanufacturer');
    }
    
    public function addManufacturer(Request $request){
        $request->validate([
            'name_manufacturer' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z0-9À-ỹ\s\.,\-()]+$/u',
                function ($attribute, $value, $fail) {
                    // Check for whitespace-only input
                    if (trim($value) === '') {
                        $fail('Tên hãng sản xuất không được chỉ chứa khoảng trắng.');
                    }
                    // Check for duplicate manufacturer name
                    if (Manufacturer::where('name_manufacturer', trim($value))->exists()) {
                        $fail('Tên hãng sản xuất này đã tồn tại.');
                    }
                }
            ],
            'image_manufacturer' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $extension = strtolower($value->getClientOriginalExtension());
                        if ($extension === 'pdf') {
                            $fail('Không chấp nhận file PDF. Vui lòng chọn file ảnh.');
                        }
                    }
                }
            ]
        ], [
            'name_manufacturer.required' => 'Vui lòng nhập tên hãng sản xuất',
            'name_manufacturer.max' => 'Tên hãng không quá 100 ký tự',
            'name_manufacturer.regex' => 'Tên hãng chỉ được chứa chữ, số và một số ký tự hợp lệ',
            'image_manufacturer.required' => 'Vui lòng chọn ảnh hãng sản xuất',
            'image_manufacturer.image' => 'File phải là ảnh',
            'image_manufacturer.mimes' => 'Chỉ chấp nhận ảnh jpeg, png, jpg, gif',
            'image_manufacturer.max' => 'Ảnh không quá 2MB',
        ]);

        $data = $request->all();
        $data['name_manufacturer'] = trim($data['name_manufacturer']);

        if($request->hasFile('image_manufacturer'))
        {
            $file = $request->file('image_manufacturer');
            $ex = $file->getClientOriginalExtension();
            $filename = time().'.'.$ex;
            $file->move('uploads/manufacturerimage/',$filename);
            $data['image_manufacturer'] = $filename;
        }

        try {
            Manufacturer::createManufacturer($data);
            return redirect()->route('manufacturer.listmanufacturer')->with('success', 'Thêm hãng sản xuất thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm hãng sản xuất. Vui lòng thử lại.');
        }
    }

    public function deleteManufacturer(Request $request){
        $manufacturer_id = $request->get('id');
        
        // Check if manufacturer exists
        $manufacturer = Manufacturer::find($manufacturer_id);
        if (!$manufacturer) {
            return redirect()->route('manufacturer.listmanufacturer')
                ->with('error', 'Không tìm thấy hãng sản xuất này!');
        }

        try {
            Manufacturer::destroy($manufacturer_id);
            return redirect()->route('manufacturer.listmanufacturer')
                ->with('success', 'Xóa hãng sản xuất thành công!');
        } catch (\Exception $e) {
            return redirect()->route('manufacturer.listmanufacturer')
                ->with('error', 'Không thể xóa hãng sản xuất này. Có thể đã bị xóa bởi người dùng khác.');
        }
    }
    
    public function indexUpdateManufacturer(Request $request){
        $manufacturer_id = $request->get('id');
        $manufacturer = Manufacturer::findManufacturerById($manufacturer_id);
        return view('admin.manufacturer.updatemanufacturer', ['manufacturer' => $manufacturer]);
    }

    public function updateManufacturer(Request $request){
        $data = $request->all();
        $manufacturer_id = $request->input('id');
        $manufacturer = Manufacturer::findManufacturerById($manufacturer_id);
        if (!$manufacturer) {
            return redirect()->route('manufacturer.listmanufacturer')->with('error', 'Không tìm thấy hãng sản xuất!');
        }

        if($request->hasFile('image_manufacturer')) {
            $file = $request->file('image_manufacturer');
            $ex = $file->getClientOriginalExtension();
            $filename = time().'.'.$ex;
            $file->move('uploads/manufacturerimage/', $filename);
            $data['image_manufacturer'] = $filename;
        } else {
            $data['image_manufacturer'] = $manufacturer->image_manufacturer;
        }

        Manufacturer::updateManufacturerById($manufacturer_id, $data);
        return redirect()->route('manufacturer.listmanufacturer')->with('success', 'Cập nhật hãng sản xuất thành công!');
    }
}