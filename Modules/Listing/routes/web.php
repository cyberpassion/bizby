<?php

use Illuminate\Support\Facades\Route;
use Modules\Listing\Http\Controllers\ListingController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('listings', ListingController::class)->names('listing');
	// Custom Routes
    Route::prefix('listing')->name('listing.')->group(function () {
        Route::get('home', [ListingController::class, 'home'])->name('home');
        Route::get('list', [ListingController::class, 'list'])->name('list');
        Route::get('report', [ListingController::class, 'report'])->name('report');
        Route::get('settings', [ListingController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [ListingController::class, 'view'])->name('view');
        Route::get('{id}/edit', [ListingController::class, 'edit'])->name('edit');
    });
});
