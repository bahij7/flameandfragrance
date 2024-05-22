<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\SocialiteController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', [BasicController::class, 'index']);

Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback']);

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/products', function () {
        return view('admin.products');
    });

    Route::get('/dashboard/ad', [AdsController::class, 'index']);
    Route::post('/dashboard/ad/store', [AdsController::class, 'store'])->name('ad.store');
    Route::put('/dashboard/ad/update', [AdsController::class, 'update'])->name('ad.update');
    Route::delete('/dashboard/ad/{id}', [AdsController::class, 'destroy'])->name('ad.delete');



});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
