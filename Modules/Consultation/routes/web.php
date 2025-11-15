<?php

use Illuminate\Support\Facades\Route;
use Modules\Consultation\Http\Controllers\ConsultationController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('consultation', ConsultationController::class)->names('consultation');
	// Custom Routes
    Route::prefix('consultation')->name('consultation.')->group(function () {
        Route::get('/list', [ConsultationController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [ConsultationController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [ConsultationController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [ConsultationController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [ConsultationController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [ConsultationController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [ConsultationController::class, 'document'])->name('document'); // List of documents like slips
    });
});