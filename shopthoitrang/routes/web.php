<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminDashboardController;

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

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('category', [CategoryController::class, 'indexCategory'])->name('category.index');
Route::get('categorycreate', [CategoryController::class, 'indexcreateCategory'])->name('category.createindex');
Route::post('categorycreate', [CategoryController::class, 'createCategory'])->name('category.createCategory');
Route::get('categoryupdate', [CategoryController::class, 'indexupdateCategory'])->name('category.updateindex');
Route::post('categoryupdate', [CategoryController::class, 'updateCategory'])->name('category.updateCategory');
Route::get('categorydelete', [CategoryController::class, 'deleteCategory'])->name('category.deleteCategory');

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


