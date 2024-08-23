<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function () {
    return view('errors.404');
});

Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::middleware('auth')->group(function () {
    Route::prefix('/home')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        // Route::get('/search', [HomeController::class, 'search'])->name('search');
    });
    Route::prefix('/product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product');
        Route::post('/', [ProductController::class, 'store'])->name('product.post');
        Route::get('/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::patch('/update/{id}', [ProductController::class, 'update'])->name('product.change');
        Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    });
    Route::prefix('/history')->group(function () {
        Route::get('/', [HistoryController::class, 'index'])->name('history');
    });
    Route::prefix('/promo')->group(function () {
        Route::get('/', [PromoController::class, 'index'])->name('promo');
        Route::get('/create', [PromoController::class, 'create'])->name('promo.create');
        Route::post('/', [PromoController::class, 'store'])->name('promo.post');
        Route::get('/{id}', [PromoController::class, 'edit'])->name('promo.edit');
        Route::put('/{id}', [PromoController::class, 'update'])->name('promo.updated');
        Route::delete('/{id}', [PromoController::class, 'destroy'])->name('promo.delete');
        Route::get('/delete_product/{id}', [PromoController::class, 'deleteProduct'])->name('promo.productDelete');
        Route::delete('/delete_product/{id}', [PromoController::class, 'destroyProduct'])->name('promo.productDelete.destroy');
    });

    Route::prefix('/cart')->group(function () {
        Route::post('/', [CartController::class, 'store'])->name('add_cart');
        Route::delete('/{id}', [CartController::class, 'destroy'])->name('delete_cart');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
