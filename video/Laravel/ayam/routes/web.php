<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [ProductController::class, 'index'])->name('menu');
Route::get('/category/{slug}', [ProductController::class, 'category'])->name('category');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Auth routes
Auth::routes();

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
});