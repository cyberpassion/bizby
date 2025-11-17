<?php

use Illuminate\Support\Facades\Route;
use Modules\Signup\Http\Controllers\SignupController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('signup', SignupController::class)->names('signup');
	// Custom Routes
    Route::prefix('signup')->name('signup.')->group(function () {
        Route::get('/list', [SignupController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [SignupController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [SignupController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [SignupController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [SignupController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [SignupController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [SignupController::class, 'document'])->name('document'); // List of documents like slips
    });
});
