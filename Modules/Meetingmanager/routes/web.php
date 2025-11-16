<?php

use Illuminate\Support\Facades\Route;
use Modules\Meetingmanager\Http\Controllers\MeetingmanagerController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('meetingmanager', MeetingmanagerController::class)->names('meetingmanager');
	// Custom Routes
    Route::prefix('meetingmanager')->name('meetingmanager.')->group(function () {
        Route::get('/list', [MeetingmanagerController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [MeetingmanagerController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [MeetingmanagerController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [MeetingmanagerController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [MeetingmanagerController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [MeetingmanagerController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [MeetingmanagerController::class, 'document'])->name('document'); // List of documents like slips
    });
});