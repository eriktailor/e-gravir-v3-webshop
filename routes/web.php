<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::prefix('admin')->controller(AdminController::class)->middleware('auth')->group(function () {
    Route::get('/products/create', 'index')->name('admin.index'); 
});

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/admin/products/create', function () {
    return view('admin.products.create');
});