<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionsController;
use App\Models\Transaction;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/home', [ProductsController::class, 'cards'])->name('home');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'cards'])->name('admin');

    Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
    Route::post('/customers', [AdminController::class, 'deleteCustomers'])->name('deleteCustomers');
    Route::resource('/products', ProductsController::class);
    Route::resource('/transactions', TransactionsController::class);
    Route::post('/transactions/update-status/{id}', [TransactionsController::class, 'updateStatus'])->name('transactions.updateStatus');
    Route::get('/profil-admin', [AdminController::class, 'profil'])->name('profil-admin');
    Route::post('/profil-admin', [AdminController::class, 'profilUpda   te'])->name('profil-update');
});

Route::get('/profil', [UserController::class, 'profil'])->name('profil');
Route::post('/profil', [UserController::class, 'profilUpdate'])->name('profil-update');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profil-user', [UserController::class, 'profil'])->name('profil-user');
    Route::post('/profil-user', [UserController::class, 'profilUpdate'])->name('profil-update');
    Route::get('/my-transactions', [TransactionsController::class, 'getMyTrasactions'])->name('my-transactions');
});

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    //     Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    // Route::get('/cart', [CartController::class, 'index'])->name('checkout.index'); // Menampilkan form checkout
    Route::post('/cart', [CartController::class, 'store'])->name('checkout.store'); // Memproses form checkout
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::get('/detail-produk/{id}', [ProductsController::class, 'show'])->name('detail-produk')->middleware('auth');
Route::post('/detail-produk{id}', [CartController::class, 'add'])->name('add-cart');


Route::get('/register', [AuthController::class, 'registerForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
