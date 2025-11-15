<?php

use Illuminate\Support\Facades\Route;
use Modules\Announcement\Http\Controllers\AnnouncementController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('announcement', AnnouncementController::class)->names('announcement');
	// Custom Routes
    Route::prefix('announcement')->name('announcement.')->group(function () {
        Route::get('/list', [AnnouncementController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [AnnouncementController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [AnnouncementController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [AnnouncementController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [AnnouncementController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [AnnouncementController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [AnnouncementController::class, 'document'])->name('document'); // List of documents like slips
    });
});

