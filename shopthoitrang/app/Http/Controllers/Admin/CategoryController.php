<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function indexCategory(){
        $cate = Category::all();
        return view('admin.category.categoryIndex', ['categories' => $cate]);
    }

    public function indexcreateCategory(){
        return view('admin.category.categoryCreateIndex');
    }
    
    public function createCategory(Request $request)
    {
        $data = $request->all();

         if($request->hasFile('image_categori'))
        {
            $file = $request->file('image_categori');
            $ex = $file->getClientOriginalExtension();
            $filename = time().'.'.$ex;
            $file->move('uploads/categoriesimage/',$filename);
            $data['image_categori'] = $filename;
        }

        Category::createCategory($data);

        return redirect('category');
    }

    public function indexupdateCategory(Request $request)
    {
        $cate_id = $request->get('id');
        $cate = Category::where('id_category', $cate_id)->first();      

        return view('admin.category.categoryUpdateIndex', ['category' => $cate]);
    }

    public function updateCategory(Request $request)
    {
        $data = $request->all();
        $category_id = $request->input('id');
        $category = Category::findCategoryById($category_id);
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Không tìm thấy hãng sản xuất!');
        }

        if($request->hasFile('image_categori')) {
            $file = $request->file('image_categori');
            $ex = $file->getClientOriginalExtension();
            $filename = time().'.'.$ex;
            $file->move('uploads/categoriesimage/', $filename);
            $data['image_categori'] = $filename;
        } else {
            $data['image_categori'] = $category->image_category;
        }

        Category::updateCategoryById($category_id, $data);
        return redirect('category');
    }

    public function deleteCategory(Request $request)
    {
        $cate_id = $request->get('id');
        $cate = Category::destroy($cate_id);
        return redirect('category')->withSuccess('You have Signed-in');
    }
}