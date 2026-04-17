<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [AdminLoginController::class, 'create'])
->name('admin.login.form');

Route::post('/admin/login', [AdminLoginController::class, 'store'])
->name('admin.login');

Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['AdminProtectMiddleware'])->group(function () {
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::get('/products/{product}/edit-data', [App\Http\Controllers\Admin\ProductController::class, 'editData'])->name('products.edit-data');
});

/*
GET `/register` → `AuthController@showRegisterForm` (name: `register`)      
POST `/register` → `AuthController@register`      
GET `/login` → `AuthController@showLoginForm` (name: `login`)      
POST `/login` → `AuthController@login`      
POST `/logout` → `AuthController@logout` (name: `logout`)      
GET `/forgot-password` → `AuthController@showForgotForm` (name: `password.request`)      
POST `/forgot-password` → `AuthController@sendResetLink` (name: `password.email`)      
GET `/reset-password/{token}` → `AuthController@showResetForm` (name: `password.reset`)      
POST `/reset-password` → `AuthController@reset` (name: `password.update`)
*/

Route::get('/register', [AuthController::class, 'showRegisterForm'])
->name('user.register.form');

Route::post('/register', [AuthController::class, 'register'])
->name('user.register');

Route::get('/', [AuthController::class, 'showLoginForm'])
->name('user.login.form');

Route::post('/', [AuthController::class, 'login'])
->name('user.login');
// not tested until now because there is no user view to add the logout button to yet
Route::post('/logout', [AuthController::class, 'logout'])
->name('user.logout');

Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])
->name('user.forgot.form');

Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
->name('user.forgot');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])
->name('password.reset'); /* you shouuuld name the route exactly "password.reset"
because there is a method called "$status = Password::sendResetLink(" that appearently doesnt accept
by default any route name but "password.reset" for a reason i dont know */ 

Route::post('/reset-password', [AuthController::class, 'reset'])
->name('user.reset');

// this is a test only route for the logout
Route::get('/logout-form', [AuthController::class, 'showLogoutForm'])
->name('user.logout.form');