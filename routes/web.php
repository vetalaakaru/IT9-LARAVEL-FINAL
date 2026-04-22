<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\SellerController;
use App\Http\Controllers\BuyerController; // Added for marketplace logic

// --- Public Views ---
Route::get('/', function () {
    // Updated to match the flower boutique theme
    $products = [
        ['name' => 'Rose Bouquet', 'price' => 1200, 'image' => '/images/roses.jpg'],
        ['name' => 'Sunflower Box', 'price' => 850, 'image' => '/images/sunflowers.jpg'],
    ];
    return view('home', compact('products'));
})->name('home');

Route::get('/shop', fn() => view('shop'))->name('shop');
Route::get('/bestsellers', function() {
    $products = [
        ['name' => 'Premium Tulips', 'price' => 1500, 'image' => '/images/tulips.jpg'],
        ['name' => 'Orchid Arrangement', 'price' => 2500, 'image' => '/images/orchids.jpg'],
    ];
    return view('bestsellers', compact('products'));
})->name('bestsellers');

Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contact', fn() => view('contact'))->name('contact');

// --- Secret Admin Entrance ---
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

    // --- SELLER CENTER ---
    // Updated route names to match the destroy method in your controller
    Route::get('/seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::post('/seller/product/store', [SellerController::class, 'store'])->name('seller.product.store');
    Route::delete('/seller/product/delete/{id}', [SellerController::class, 'destroy'])->name('seller.product.delete');

    // --- BUYER DASHBOARD & CART ---
    // Connected to the BuyerController logic for marketplace management
    Route::get('/buyer/dashboard', [BuyerController::class, 'index'])->name('buyer.dashboard');
    Route::post('/buyer/cart/add/{id}', [BuyerController::class, 'addToCart'])->name('buyer.cart.add');
    Route::delete('/buyer/cart/remove/{id}', [BuyerController::class, 'removeFromCart'])->name('buyer.cart.remove');
    Route::get('/buyer/messages', fn() => view('buyer.messages'))->name('buyer.messages');
});