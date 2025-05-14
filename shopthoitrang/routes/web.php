<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\ManufacturerControllerUser;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductControllerUser;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('dashboard', [CategoryController::class, 'dashboard']);

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home.index');


Route::get('dashboard', [CategoryController::class, 'dashboard']);

Route::get('category', [CategoryController::class, 'indexCategory'])->name('category.index');
Route::get('categorycreate', [CategoryController::class, 'indexcreateCategory'])->name('category.createindex');
Route::post('categorycreate', [CategoryController::class, 'createCategory'])->name('category.createCategory');
Route::get('categoryupdate', [CategoryController::class, 'indexupdateCategory'])->name('category.updateindex');
Route::post('categoryupdate', [CategoryController::class, 'updateCategory'])->name('category.updateCategory');
Route::get('categorydelete', [CategoryController::class, 'deleteCategory'])->name('category.deleteCategory');

//product
Route::get('listproduct', [ProductController::class, 'indexProduct'])->name('product.listproduct');
Route::get('addproduct', [ProductController::class, 'indexAddProduct'])->name('product.indexaddproduct');
Route::post('addproduct', [ProductController::class, 'addProduct'])->name('product.addproduct');
Route::get('deleteproduct', [ProductController::class, 'deleteProduct'])->name('product.deleteproduct');
Route::get('updateproduct', [ProductController::class, 'indexUpdateProduct'])->name('product.indexUpdateproduct');
Route::post('updateproduct', [ProductController::class, 'updateProduct'])->name('product.updateproduct');

// Register Client
Route::get('/register',[CustomerController::class,'indexRegister']);
Route::post('/register',[CustomerController::class,'authRegister'])->name('user.cus_register');

// Login client
Route::get('/login',[CustomerController::class,'indexLogin'])->name('user.indexlogin');
Route::post('/login',[CustomerController::class,'authLogin'])->name('user.cus_login');

// Logout
Route::get('/signout', [CustomerController::class, 'signOut'])->name('signout');

// List user Admin
Route::get('/listuser',[AdminUserController::class,'listUser'])->name('user.listuser');
//  Delete user admin
Route::get('deleteuser',[AdminUserController::class,'deleteUser'])->name('user.deleteUser');

// Update user admin
Route::get('/updateuser',[AdminUserController::class,'updateUser'])->name('user.updateUser');
Route::post('/updateuser',[AdminUserController::class,'postUpdateUser'])->name('user.postUpdateUser');

// List_user  Search User
route::get('/search',[AdminUserController::class,'searchUser'])->name('user.searchUser');

Route::get('/admin/dashboard', [AdminUserController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/listproduct', function() {
    return 'Chức năng Sản Phẩm đang phát triển';
})->name('product.listproduct');

Route::get('/admin/order', function() {
    return 'Chức năng Đơn Hàng đang phát triển';
})->name('admin.orderindexAdmin');

Route::get('/admin/manufacturer', function() {
    return 'Chức năng Hãng Sản Xuất đang phát triển';
})->name('manufacturer.listmanufacturer');

Route::get('/manufacture', [ManufacturerControllerUser::class, 'indexmanufacture'])->name('manufacture.indexmanufacture');
Route::get('/manufacturer/{id}', [ManufacturerControllerUser::class, 'showProductsByManufacturer'])->name('manufacturer.products');

//manufacturer
Route::get('listmanufacturer', [ManufacturerController::class, 'indexManufacturer'])->name('manufacturer.listmanufacturer');
Route::get('addmanufacturer', [ManufacturerController::class, 'indexAddManufacturer'])->name('manufacturer.addmanufacturer');
Route::post('addmanufacturer', [ManufacturerController::class, 'addManufacturer']);
Route::get('deletemanufacturer', [ManufacturerController::class, 'deleteManufacturer'])->name('manufacturer.deletemanufacturer');

Route::get('detailproduct', [HomeController::class, 'indexDetailProduct'])->name('product.indexDetailproduct');

//search and filter
Route::get('/filterProduct', [ProductControllerUser::class, 'filterProduct'])->name('user.filterProduct');
Route::get('/searchProduct', [ProductControllerUser::class, 'searchProduct'])->name('user.searchProduct');
