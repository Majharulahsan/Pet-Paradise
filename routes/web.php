<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FirebaseController;

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

// --- Authentication ---
Route::get('/login', [FirebaseController::class, 'showLogin'])->name('login');
Route::post('/login', [FirebaseController::class, 'login']);
Route::get('/register', [FirebaseController::class, 'showRegister'])->name('register');
Route::post('/register', [FirebaseController::class, 'register']);
Route::post('/logout', [FirebaseController::class, 'logout'])->name('logout');

// --- Admin Routes ---
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/products', [ProductController::class, 'adminProducts'])->name('admin.products');
    Route::get('/admin/products/create', [ProductController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'storeProduct'])->name('admin.products.store');
    Route::delete('/admin/products/{id}', [ProductController::class, 'deleteProduct'])->name('admin.products.delete');

    // User Management Routes
    Route::get('/admin/users', [FirebaseController::class, 'listUsers'])->name('admin.users');
    Route::post('/admin/users/{user}/make-admin', [FirebaseController::class, 'makeAdmin'])->name('admin.users.make-admin');
    Route::post('/admin/users/{user}/remove-admin', [FirebaseController::class, 'removeAdmin'])->name('admin.users.remove-admin');
});