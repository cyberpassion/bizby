<?php

use Illuminate\Support\Facades\Route;
use Modules\Registration\Http\Controllers\RegistrationController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('registration', RegistrationController::class)->names('registration');
	// Custom Routes
    Route::prefix('registration')->name('registration.')->group(function () {
        Route::get('/list', [RegistrationController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [RegistrationController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [RegistrationController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [RegistrationController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [RegistrationController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [RegistrationController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [RegistrationController::class, 'document'])->name('document'); // List of documents like slips
    });
});
