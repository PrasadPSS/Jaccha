<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/products', [ProductController::class, 'index'])
->middleware(['auth', 'verified'])->name('product.index');

Route::get('/product/buy/{product_id}/{quantity}', [ProductController::class, 'buy'])
->middleware(['auth', 'verified'])->name('product.buy');

Route::get('/product/addtocart/{product_id}/{quantity}', [ProductController::class, 'addtocart'])
->middleware(['auth', 'verified'])->name('product.add');

Route::get('/cart/view', [CartController::class, 'index'])
->middleware(['auth', 'verified'])->name('cart.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
