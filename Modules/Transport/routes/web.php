<?php

use Illuminate\Support\Facades\Route;
use Modules\Transport\Http\Controllers\TransportController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('transport', TransportController::class)->names('transport');
	// Custom Routes
    Route::prefix('transport')->name('transport.')->group(function () {
        Route::get('/list', [TransportController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [TransportController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [TransportController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [TransportController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [TransportController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [TransportController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [TransportController::class, 'document'])->name('document'); // List of documents like slips
    });
});
