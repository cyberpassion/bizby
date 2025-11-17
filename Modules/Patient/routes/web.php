<?php

use Illuminate\Support\Facades\Route;
use Modules\Patient\Http\Controllers\PatientController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('patient', PatientController::class)->names('patient');
	// Custom Routes
    Route::prefix('patient')->name('patient.')->group(function () {
        Route::get('/list', [PatientController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [PatientController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [PatientController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [PatientController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [PatientController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [PatientController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [PatientController::class, 'document'])->name('document'); // List of documents like slips
    });
});
