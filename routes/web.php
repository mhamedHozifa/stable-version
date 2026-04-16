<?php

use App\Http\Controllers\Admin\AdminLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [AdminLoginController::class, 'create'])
->name('admin.login.form');

Route::post('/admin/login', [AdminLoginController::class, 'store'])
->name('admin.login');

Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['AdminProtectMiddleware'])->group(function () {
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::get('/products/{product}/edit-data', [App\Http\Controllers\Admin\ProductController::class, 'editData'])->name('products.edit-data');
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class); 

    
});

