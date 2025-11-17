<?php

use Illuminate\Support\Facades\Route;
use Modules\Booking\Http\Controllers\BookingController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('booking', BookingController::class)->names('booking');
	// Custom Routes
    Route::prefix('booking')->name('booking.')->group(function () {
        Route::get('/list', [BookingController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [BookingController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [BookingController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [BookingController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [BookingController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [BookingController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [BookingController::class, 'document'])->name('document'); // List of documents like slips
    });
});
