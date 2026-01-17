<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Home & Static Pages ---
Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', function () { return view('contact'); })->name('contact');

// --- Shop & Products ---
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
Route::get('/product/{id}', [ProductController::class, 'productDetail'])->name('product.detail');
Route::get('/search', [ProductController::class, 'search'])->name('search');

// --- Cart & Checkout ---
Route::post('/cart/add', [ProductController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [ProductController::class, 'updateCart'])->name('cart.update');
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::post('/order/place', [ProductController::class, 'placeOrder'])->name('order.place');
Route::get('/thankyou', [ProductController::class, 'thankYou'])->name('thankyou');

// --- Services ---
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/health', [ServiceController::class, 'health'])->name('services.health');
Route::get('/services/vet', [ServiceController::class, 'vet'])->name('services.vet');
Route::get('/services/daycare', [ServiceController::class, 'daycare'])->name('services.daycare');

// --- Appointments ---
Route::get('/appointment', function () {
    return view('appointment');
})->name('appointment.index');