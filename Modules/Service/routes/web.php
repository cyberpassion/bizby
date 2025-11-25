<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\ServiceController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('service', ServiceController::class)->names('service');
	// Custom Routes
    Route::prefix('service')->name('service.')->group(function () {
        Route::get('/list', [ServiceController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [ServiceController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [ServiceController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [ServiceController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [ServiceController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [ServiceController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [ServiceController::class, 'document'])->name('document'); // List of documents like slips
    });
});
