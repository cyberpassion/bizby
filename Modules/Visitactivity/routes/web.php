<?php

use Illuminate\Support\Facades\Route;
use Modules\Visitactivity\Http\Controllers\VisitactivityController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('visitactivity', VisitactivityController::class)->names('visitactivity');
	// Custom Routes
    Route::prefix('visitactivity')->name('visitactivity.')->group(function () {
        Route::get('/list', [VisitactivityController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [VisitactivityController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [VisitactivityController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [VisitactivityController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [VisitactivityController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [VisitactivityController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [VisitactivityController::class, 'document'])->name('document'); // List of documents like slips
    });
});
