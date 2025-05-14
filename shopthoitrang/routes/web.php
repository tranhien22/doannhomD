<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ManufacturerController;

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

Route::get('category', [CategoryController::class, 'indexCategory'])->name('category.index');
Route::get('categorycreate', [CategoryController::class, 'indexcreateCategory'])->name('category.createindex');
Route::post('categorycreate', [CategoryController::class, 'createCategory'])->name('category.createCategory');
Route::get('categoryupdate', [CategoryController::class, 'indexupdateCategory'])->name('category.updateindex');
Route::post('categoryupdate', [CategoryController::class, 'updateCategory'])->name('category.updateCategory');
Route::get('categorydelete', [CategoryController::class, 'deleteCategory'])->name('category.deleteCategory');

//manufacturer
Route::get('listmanufacturer', [ManufacturerController::class, 'indexManufacturer'])->name('manufacturer.listmanufacturer');
Route::get('addmanufacturer', [ManufacturerController::class, 'indexAddManufacturer'])->name('manufacturer.addmanufacturer');
Route::post('addmanufacturer', [ManufacturerController::class, 'addManufacturer']);
Route::get('deletemanufacturer', [ManufacturerController::class, 'deleteManufacturer'])->name('manufacturer.deletemanufacturer');