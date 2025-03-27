<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\WebshopController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;



/**
 * Auth routes
 */    
Route::prefix('admin')->controller(AuthController::class)->group(function() {
    Route::get('/', 'showLogin')->name('admin.root');
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('admin.login');
    Route::post('/logout', 'logout')->name('logout');
});

/**
 * Webshop routes
 */
Route::prefix('webshop')->group(function() {

    Route::controller(CartController::class)->group(function() {
        Route::get('/cart', 'index')->name('webshop.cart');
        Route::post('/cart/add/{product}', 'addToCart')->name('cart.add');
        Route::post('/cart/remove', 'removeFromCart')->name('cart.remove');
        Route::post('/cart/customization', 'storeCustomizations')->name('cart.customizations.store');

    });

    Route::controller(CheckoutController::class)->group(function() {
        Route::get('/checkout', 'index')->name('webshop.checkout');
        Route::post('/checkout/store', 'store')->name('checkout.store');
    });

    Route::controller(WebshopController::class)->group(function() {
        Route::get('/', 'index')->name('webshop.home');
        Route::get('/{category}/{product}', 'single')->name('webshop.single');
        Route::get('/{slug}', 'archive')->name('webshop.archive'); // Keep last!
    });
});

/**
 * Static page routes
 */
Route::controller(PageController::class)->group(function() {
    Route::get('/aszf', 'terms')->name('page.terms');
    Route::get('/adatvedelem', 'privacy')->name('page.privacy');
});

/**
 * Admin routes
 */
Route::prefix('admin')->middleware('auth')->group(function () {

    // Orders
    Route::resource('orders', OrderController::class)->except(['destroy']);
    Route::get('orders/{order}/download-images', [OrderController::class, 'downloadImages'])->name('orders.downloadImages');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');


    // Products
    Route::resource('products', ProductController::class)->except(['show']);
    Route::get('products/variation-item', [ProductController::class, 'variationItem']);
    Route::get('products/variation-row', [ProductController::class, 'variationRow']);


    // Product Images
    Route::delete('product-images/{image}', [ProductImageController::class, 'destroy'])->name('product-images.destroy');
    Route::post('product-images/reorder', [ProductImageController::class, 'reorder']);
    

    // Categories
    Route::resource('categories', ProductCategoryController::class);
    Route::post('categories/reorder', [ProductCategoryController::class, 'reorder'])->name('categories.reorder');

});

/* 
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

use Illuminate\Support\Facades\Storage;

Route::get('/image', function () {
    $manager = new ImageManager(new Driver());
    $image = $manager->read('storage/categories/2/2007zCcnQzD5ac2RakPnzkKab0m7Gv7K0IPsruu9.jpg');

    $image->scale(width: 500);    

    return response($image->toWebp())->header('Content-Type', 'image/webp');
});
 */





