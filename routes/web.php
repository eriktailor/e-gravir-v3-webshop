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

Route::get('/', function () {
    return view('auth.login');
});