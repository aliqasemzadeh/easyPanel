<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/dashboard/index', [\App\Http\Controllers\Admin\DashbaordController::class, 'index'])->name('admin.dashboard.index');

    Route::get('/product/index', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/product/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.product.create');
    Route::get('/product/edit/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('/product/store', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.product.store');
    Route::post('/product/update/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/product/delete/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('admin.product.delete');

});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add-cart/{product}', [App\Http\Controllers\HomeController::class, 'addCart'])->name('add-cart');
Route::get('/remove-cart/{product}', [App\Http\Controllers\HomeController::class, 'removeCart'])->name('remove-cart');
Route::get('/cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');
Route::get('/payment', [App\Http\Controllers\HomeController::class, 'payment'])->name('payment');
