<?php

use Illuminate\Support\Facades\Route;
use Modules\Leaveapplication\Http\Controllers\LeaveapplicationController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('leaveapplication', LeaveapplicationController::class)->names('leaveapplication');
	// Custom Routes
    Route::prefix('leaveapplication')->name('leaveapplication.')->group(function () {
        Route::get('/list', [LeaveapplicationController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [LeaveapplicationController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [LeaveapplicationController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [LeaveapplicationController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [LeaveapplicationController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [LeaveapplicationController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [LeaveapplicationController::class, 'document'])->name('document'); // List of documents like slips
    });
});
