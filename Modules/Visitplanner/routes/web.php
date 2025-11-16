<?php

use Illuminate\Support\Facades\Route;
use Modules\Visitplanner\Http\Controllers\VisitplannerController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('visitplanner', VisitplannerController::class)->names('visitplanner');
	// Custom Routes
    Route::prefix('visitplanner')->name('visitplanner.')->group(function () {
        Route::get('/list', [VisitplannerController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [VisitplannerController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [VisitplannerController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [VisitplannerController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [VisitplannerController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [VisitplannerController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [VisitplannerController::class, 'document'])->name('document'); // List of documents like slips
    });
});
