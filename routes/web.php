<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Home Page Route (The '/' path now points to the home method in ProductController)
Route::get('/', [ProductController::class, 'home'])->name('home');

// Shop Listing Page Route
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');

// Product Detail Page Route (uses a dynamic ID parameter)
Route::get('/product/{id}', [ProductController::class, 'productDetail'])->name('product.detail');