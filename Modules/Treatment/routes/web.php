<?php

use Illuminate\Support\Facades\Route;
use Modules\Treatment\Http\Controllers\TreatmentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('treatment', TreatmentController::class)->names('treatment');
	// Custom Routes
    Route::prefix('treatment')->name('treatment.')->group(function () {
        Route::get('/list', [TreatmentController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [TreatmentController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [TreatmentController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [TreatmentController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [TreatmentController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [TreatmentController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [TreatmentController::class, 'document'])->name('document'); // List of documents like slips
    });
});
