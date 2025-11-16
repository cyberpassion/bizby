<?php

use Illuminate\Support\Facades\Route;
use Modules\Timetable\Http\Controllers\TimetableController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('timetable', TimetableController::class)->names('timetable');
	// Custom Routes
    Route::prefix('timetable')->name('timetable.')->group(function () {
        Route::get('/list', [TimetableController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [TimetableController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [TimetableController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [TimetableController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [TimetableController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [TimetableController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [TimetableController::class, 'document'])->name('document'); // List of documents like slips
    });
});
