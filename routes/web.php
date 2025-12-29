<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
