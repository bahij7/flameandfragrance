<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdvantagesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SocialiteController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', [BasicController::class, 'index']);
Route::get('/products', [ProductController::class, 'index'])->name('product');
Route::get('/products/{slug}', [ProductController::class, 'view'])->name('product.view');

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');




Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/products', [ProductController::class, 'fetch'])->name('product.index');
    Route::get('/dashboard/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/dashboard/products/create', [ProductController::class, 'store'])->name('product.store');

    Route::get('/dashboard/products/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/dashboard/products/edit/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::put('/dashboard/products/{id}/publish', [ProductController::class, 'publish'])->name('product.publish');
    Route::get('/dashboard/products/view/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::delete('/dashboard/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/dashboard/ad', [AdsController::class, 'index']);
    Route::post('/dashboard/ad/store', [AdsController::class, 'store'])->name('ad.store');
    Route::put('/dashboard/ad/update', [AdsController::class, 'update'])->name('ad.update');
    Route::delete('/dashboard/ad/{id}', [AdsController::class, 'destroy'])->name('ad.delete');

    Route::get('/dashboard/advantages', [AdvantagesController::class, 'index']);
    Route::post('/dashboard/advantages/store', [AdvantagesController::class, 'store'])->name('advantages.store');




});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
