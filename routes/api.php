<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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


Route::resource('/products', ProductsController::class);

Route::get('/profil-user', [UserController::class, 'profil']);

Route::get('products/{id}', [ProductsController::class, 'show']);
Route::put('products/{id}', [ProductsController::class, 'update']);

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');