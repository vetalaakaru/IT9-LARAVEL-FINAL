<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\SellerController; // Added SellerController

// --- Public Views ---
Route::get('/', function () {
    $products = [
        ['name' => 'Rice (5kg)', 'price' => 250, 'image' => '/images/rice.jpg'],
        ['name' => 'Cooking Oil', 'price' => 120, 'image' => '/images/oil.jpg'],
    ];
    return view('home', compact('products'));
})->name('home');

Route::get('/shop', fn() => view('shop'))->name('shop');
Route::get('/bestsellers', function() {
    $products = [
        ['name' => 'Premium Rice', 'price' => 300, 'image' => '/images/rice.jpg'],
        ['name' => 'Organic Oil', 'price' => 150, 'image' => '/images/oil.jpg'],
    ];
    return view('bestsellers', compact('products'));
})->name('bestsellers');

Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contact', fn() => view('contact'))->name('contact');

// --- Secret Admin Entrance (Option 2) ---
Route::get('/portal', fn() => view('buyer.login'))->name('admin.secret.portal');

// --- Auth & Role Selection ---
Route::get('/chooseRole', fn() => view('chooseRole'))->name('chooseRole');
Route::get('/buyer/login', fn() => view('buyer.login'))->name('buyer.login');
Route::get('/buyer/signup', fn() => view('buyer.signup'))->name('buyer.signup');
Route::get('/seller/signup', fn() => view('seller.signup'))->name('seller.signup');

// --- Form Actions ---
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Protected Routes (Requires Login) ---
Route::middleware(['auth'])->group(function () {
    
    // --- ADMIN DASHBOARD ---
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/reject/{id}', [AdminController::class, 'reject'])->name('admin.reject');

    // --- SELLER DASHBOARD & PRODUCT MGMT ---
    Route::get('/seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::post('/seller/product/store', [SellerController::class, 'storeProduct'])->name('seller.product.store');
    Route::get('/seller/product/edit/{id}', [SellerController::class, 'editProduct'])->name('seller.product.edit');
    Route::post('/seller/product/update/{id}', [SellerController::class, 'updateProduct'])->name('seller.product.update');
    Route::delete('/seller/product/delete/{id}', [SellerController::class, 'deleteProduct'])->name('seller.product.delete');

    // --- BUYER DASHBOARD ---
    Route::get('/buyer/dashboard', fn() => view('buyer.dashboard'))->name('buyer.dashboard');
    Route::get('/buyer/messages', fn() => view('buyer.messages'))->name('buyer.messages');
});