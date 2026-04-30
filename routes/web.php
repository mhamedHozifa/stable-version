<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\AuthController;
use App\Models\Order; // Needed for route model binding type hints
use App\Http\Controllers\User\ProfileController;
use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [AdminLoginController::class, 'create'])
->name('admin.login.form');

Route::post('/admin/login', [AdminLoginController::class, 'store'])
->name('admin.login');



Route::prefix('admin')->middleware(['AdminProtectMiddleware'])->group(function () {
    Route::get('/', function () {
            return view('admin.dashboard', [
                'productsCount' => Product::count(),
                'categoriesCount' => Category::count(),
                'featuredCount' => Product::where('is_featured', true)->count(),
                'lowStockCount' => Product::where('stock', '<=', 5)->count(),
            ]);
        })->name('dashboard');
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::get('/products/{product}/edit-data', [App\Http\Controllers\Admin\ProductController::class, 'editData'])->name('products.edit-data');
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class); 
    Route::get('/categories/{category}/edit-data', [App\Http\Controllers\Admin\CategoryController::class, 'editData'])->name('categories.edit-data');
    /* logout route should be protected with the middleware because it exists inside the admin
    dashboard page which doesnt allow any route that is not protected with the 
    amiddleware */
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Order management routes
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');
    Route::post('/orders/{order}/refund', [OrderController::class, 'refund'])->name('admin.orders.refund');
    Route::get('/orders/{order}/packing-slip', [OrderController::class, 'packingSlip'])->name('admin.orders.packing-slip');
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

Route::get('/login', [AuthController::class, 'showLoginForm'])
->name('login');

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

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/products', [ProductController::class, 'publicIndex'])->name('shop.products.index');
Route::get('/products/{product}', [ProductController::class, 'publicShow'])->name('shop.products.show');

// Cart routes
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::patch('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/checkout', [CartController::class, 'processCheckout'])->name('cart.process-checkout');
Route::get('/products/{product}', [ProductController::class, 'publicShow'])->name('shop.products.show');