<<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\StudentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('student', StudentController::class)->names('student');
	// Custom Routes
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/list', [StudentController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [StudentController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [StudentController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [StudentController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [StudentController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [StudentController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [StudentController::class, 'document'])->name('document'); // List of documents like slips
    });
});