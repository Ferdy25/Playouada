<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// HOME PAGE
Route::get('/', function () {
    return view('home');
})->name('home');

// GROUP PRODUCT
Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('/', 'index')->name('products');
    Route::get('/create', 'create')->name('products.create');
    Route::post('/store', 'store')->name('products.store');
    Route::get('/show/{id}', 'show')->name('products.show');
    Route::get('/edit/{id}', 'edit')->name('products.edit');
    Route::put('/update/{id}', 'update')->name('products.update');
});

// GROUP CART

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index']) ->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
