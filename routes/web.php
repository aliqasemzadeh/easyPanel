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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/dashboard/index', [\App\Http\Controllers\Admin\DashbaordController::class, 'index'])->name('admin.dashboard.index');

    Route::get('/product/index', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/product/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.product.create');
    Route::get('/product/edit/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('/product/store', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.product.store');
    Route::post('/product/update/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
