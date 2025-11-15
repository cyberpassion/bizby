<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('products', ProductController::class)->names('product');
	// Custom Routes
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('home', [ProductController::class, 'home'])->name('home');
        Route::get('list', [ProductController::class, 'list'])->name('list');
        Route::get('report', [ProductController::class, 'report'])->name('report');
        Route::get('settings', [ProductController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [ProductController::class, 'view'])->name('view');
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
    });
});
