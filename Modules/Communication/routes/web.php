<?php

use Illuminate\Support\Facades\Route;
use Modules\Communication\Http\Controllers\CommunicationController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('communication', CommunicationController::class)->names('communication');
	// Custom Routes
    Route::prefix('communication')->name('communication.')->group(function () {
        Route::get('/list', [CommunicationController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [CommunicationController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [CommunicationController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [CommunicationController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [CommunicationController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [CommunicationController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [CommunicationController::class, 'document'])->name('document'); // List of documents like slips
    });
});