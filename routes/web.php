<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Home Page Route
Route::get('/', [ProductController::class, 'home'])->name('home');

// Shop Listing Page Route
Route::get('/shop', [ProductController::class, 'shop'])->name('shop');

// Product Detail Page Route
Route::get('/product/{id}', [ProductController::class, 'productDetail'])->name('product.detail');

// Checkout Page Route
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');

// --- NEW CART ROUTE ---
Route::post('/cart/add', [ProductController::class, 'addToCart'])->name('cart.add');

// In routes/web.php
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');

// Route to handle the POST request when the user clicks "Place Order"
Route::post('/order', [ProductController::class, 'placeOrder'])->name('place.order');

// NEW: Route for handling the final order placement (POST request from checkout page)
Route::post('/checkout/place-order', [ProductController::class, 'placeOrder'])->name('order.place');

Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::post('/cart/update', [ProductController::class, 'updateCart'])->name('cart.update'); // New route for quantity/remove
// POST route to handle the order submission
Route::post('/order/place', [ProductController::class, 'placeOrder'])->name('order.place');

// Your missing route that led to the error:
Route::get('/thankyou', [ProductController::class, 'thankYou'])->name('thankyou');

// Search Route
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');

// routes/web.php

Route::get('/services', function () {
    $services = []; 
    return view('services', compact('services'));
})->name('services');

Route::get('/about', function () {
    return view('about'); 
})->name('about'); 
Route::get('/contact', function () {
    return view('contact'); 
})->name('contact'); 


Route::get('/appointment', function () {
    return view('appointment');
})->name('appointment.index');

