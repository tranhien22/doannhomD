<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    public function indexManufacturer(){
        $manufacturers = Manufacturer::getManufacturersWithPagination(2);
        return view('admin.manufacturer.listManufacturer', ['manufacturers' => $manufacturers]);
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
                'regex:/^[a-zA-Z0-9À-ỹ\s\.,\-()]+$/u'
            ],
            'image_manufacturer' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
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

        if($request->hasFile('image_manufacturer'))
        {
            $file = $request->file('image_manufacturer');
            $ex = $file->getClientOriginalExtension();
            $filename = time().'.'.$ex;
            $file->move('uploads/manufacturerimage/',$filename);
            $data['image_manufacturer'] = $filename;
        }

        Manufacturer::createManufacturer($data);
        return redirect()->route('manufacturer.listmanufacturer')->with('success', 'Thêm hãng sản xuất thành công!');
    }

    public function deleteManufacturer(Request $request){
        $manufacturer_id = $request->get('id');
        Manufacturer::destroy($manufacturer_id);
        return redirect()->route('manufacturer.listmanufacturer');
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