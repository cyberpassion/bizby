<?php

use Illuminate\Support\Facades\Route;
use Modules\Checklist\Http\Controllers\ChecklistController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('checklist', ChecklistController::class)->names('checklist');
	// Custom Routes
    Route::prefix('checklist')->name('checklist.')->group(function () {
        Route::get('/list', [ChecklistController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [ChecklistController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [ChecklistController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [ChecklistController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [ChecklistController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [ChecklistController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [ChecklistController::class, 'document'])->name('document'); // List of documents like slips
    });
});
