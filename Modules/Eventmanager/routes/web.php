<?php

use Illuminate\Support\Facades\Route;
use Modules\Eventmanager\Http\Controllers\EventmanagerController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('eventmanager', EventmanagerController::class)->names('eventmanager');
	// Custom Routes
    Route::prefix('eventmanager')->name('eventmanager.')->group(function () {
        Route::get('/list', [EventmanagerController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [EventmanagerController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [EventmanagerController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [EventmanagerController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [EventmanagerController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [EventmanagerController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [EventmanagerController::class, 'document'])->name('document'); // List of documents like slips
    });
});