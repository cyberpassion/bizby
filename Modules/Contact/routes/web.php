<?php

use Illuminate\Support\Facades\Route;
use Modules\Contact\Http\Controllers\ContactController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('contact', ContactController::class)->names('contact');
	// Custom Routes
    Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('/list', [ContactController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [ContactController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [ContactController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [ContactController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [ContactController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [ContactController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [ContactController::class, 'document'])->name('document'); // List of documents like slips
    });
});
