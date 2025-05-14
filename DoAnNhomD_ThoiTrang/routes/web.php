<?php

use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\User\detailsOrderController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\ManufacturerControllerUser;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\PaymentController;
use App\Models\DetailsOrder;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\AdminUserController;

//thanh toan
Route::get('myorder', [OrderController::class, 'addOrder'])->name('order.addOrder');
Route::post('myorder', [OrderController::class, 'addOrder'])->name('order.addOrder');
Route::get('payment', [PaymentController::class, 'paymentIndex'])->name('payment.paymentindex');
Route::get('detailsorder', [detailsOrderController::class, 'addDetailsOrder'])->name('detailsorder.addDetailsOrder');
Route::get('orderindex',[OrderController::class, 'orderIndex'])->name('order.orderIndex');
Route::get('detailsorderindex',[detailsOrderController::class, 'detailsOrderIndex'])->name('detailsorder.detailsOrderIndex');

//tim kiem admin
Route::get('orderindexAdmin',[AdminOrderController::class, 'orderindexAdmin'])->name('admin.orderindexAdmin');
Route::get('adminsearchorder',[AdminOrderController::class, 'adminSearchOrder'])->name('admin.adminSearchOrder');
Route::get('detailsorderindex',[detailsOrderController::class, 'detailsOrderIndex'])->name('detailsorder.detailsOrderIndex');
Route::get('admindetailsorderindex',[AdminOrderController::class, 'adminDetailsOrderIndex'])->name('admin.adminDetailsOrderIndex');
Route::get('admindetailsorderdelete',[AdminOrderController::class, 'adminDetailsOrderDelete'])->name('admin.adminDetailsOrderDelete');

Route::get('cart/count', [CartController::class, 'getCount'])->name('cart.getCount');
Route::get('order/count', [OrderController::class, 'getCount'])->name('order.getCount');