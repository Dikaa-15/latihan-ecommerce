<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/cards-admin', [AdminController::class, 'cards']);
// Route::get('/customers', [AdminController::class, 'customers']);
// Route::delete('/customers-delete{id}', [AdminController::class, 'deleteCustomer']);

Route::resource('/customers', CustomersController::class);


Route::get('/profil-user', [UserController::class, 'profil']);

Route::get('/cards', [ProductsController::class, 'index']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('detail-products/{id}', [ProductsController::class, 'detail']);
    // route untuk menambahkan produk ke keranjang
    Route::post('products/{id}/cart', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'showCart']);
    Route::get('/profile', [UserController::class, 'profil']);
    Route::post('/profile-update', [CustomersController::class, 'update']);
    Route::resource('/customers', CustomersController::class);
});

// Route untuk menampilkan product dalam keranjang
// Route::middleware('auth:sanctum')->get('/cart', [CartController::class, 'showCart']);

Route::delete('cart/{id}', [CartController::class, 'removeFromCart'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::resource('/products', ProductsController::class);
    
});

Route::get('/cards-admin', [AdminController::class, 'cards']);

Route::put('products/{id}', [ProductsController::class, 'update']);

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
