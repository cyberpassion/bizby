<?php

use Illuminate\Support\Facades\Route;
use Modules\Attendance\Http\Controllers\AttendanceController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('attendance', AttendanceController::class)->names('attendance');
	// Custom Routes
    Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::get('/list', [AttendanceController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [AttendanceController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [AttendanceController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [AttendanceController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [AttendanceController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [AttendanceController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [AttendanceController::class, 'document'])->name('document'); // List of documents like slips
    });
});
