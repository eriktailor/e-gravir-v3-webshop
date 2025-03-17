<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\FileUploadController;

/**
 * Auth routes
 */    
Route::prefix('admin')->controller(AuthController::class)->group(function() {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('admin.login');
    Route::post('/logout', 'logout')->name('logout');
});

/**
 * Admin routes
 */
Route::prefix('admin')->middleware('auth')->group(function () {

    // Products
    Route::resource('products', ProductController::class)->except(['show']);;
    Route::get('products/variation-item', [ProductController::class, 'variationItem'])->name('products.variation-item');

    // Product Images
    Route::delete('product-images/{image}', [ProductImageController::class, 'destroy'])->name('product-images.destroy');
    Route::post('product-images/reorder', [ProductImageController::class, 'reorder']);
    

    // Categories
    Route::resource('categories', ProductCategoryController::class);
    Route::post('categories/reorder', [ProductCategoryController::class, 'reorder'])->name('categories.reorder');


});

Route::post('/upload', [FileUploadController::class, 'upload'])->name('file.upload');







Route::get('/', function () {
    return view('auth.login');
});





