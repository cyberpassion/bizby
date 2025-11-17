<?php

use Illuminate\Support\Facades\Route;
use Modules\Library\Http\Controllers\LibraryController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('library', LibraryController::class)->names('library');
	// Custom Routes
    Route::prefix('library')->name('library.')->group(function () {
        Route::get('/list', [LibraryController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [LibraryController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [LibraryController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [LibraryController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [LibraryController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [LibraryController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [LibraryController::class, 'document'])->name('document'); // List of documents like slips
    });
});
