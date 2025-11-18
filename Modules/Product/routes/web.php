<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('product', ProductController::class)->names('product');
	// Custom Routes
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/list', [ProductController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [ProductController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [ProductController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [ProductController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [ProductController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [ProductController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [ProductController::class, 'document'])->name('document'); // List of documents like slips
    });
});
