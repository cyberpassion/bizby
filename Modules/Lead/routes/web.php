<?php

use Illuminate\Support\Facades\Route;
use Modules\lead\Http\Controllers\LeadController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('lead', LeadController::class)->names('lead');
	// Custom Routes
    Route::prefix('lead')->name('lead.')->group(function () {
        Route::get('/list', [LeadController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [LeadController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [LeadController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [LeadController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [LeadController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [LeadController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [LeadController::class, 'document'])->name('document'); // List of documents like slips
    });
});