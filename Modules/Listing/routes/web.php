<?php

use Illuminate\Support\Facades\Route;
use Modules\Listing\Http\Controllers\ListingController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('listing', ListingController::class)->names('listing');
	// Custom Routes
    Route::prefix('listing')->name('listing.')->group(function () {
        Route::get('/list', [ListingController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [ListingController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [ListingController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [ListingController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [ListingController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [ListingController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [ListingController::class, 'document'])->name('document'); // List of documents like slips
    });
});
