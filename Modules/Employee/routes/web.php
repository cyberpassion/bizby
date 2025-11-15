<?php

use Illuminate\Support\Facades\Route;
use Modules\Employee\Http\Controllers\EmployeeController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('employee', EmployeeController::class)->names('employee');
	// Custom Routes
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/list', [EmployeeController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [EmployeeController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [EmployeeController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [EmployeeController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [EmployeeController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [EmployeeController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [EmployeeController::class, 'document'])->name('document'); // List of documents like slips
    });
});
