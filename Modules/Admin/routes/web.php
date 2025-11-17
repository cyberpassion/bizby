<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('admin', AdminController::class)->names('admin');
	// Custom Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/list', [AdminController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [AdminController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [AdminController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [AdminController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [AdminController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [AdminController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [AdminController::class, 'document'])->name('document'); // List of documents like slips
    });
});