<?php

use Illuminate\Support\Facades\Route;
use Modules\Note\Http\Controllers\NoteController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('note', NoteController::class)->names('note');
	// Custom Routes
    Route::prefix('note')->name('note.')->group(function () {
        Route::get('/list', [NoteController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [NoteController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [NoteController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [NoteController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [NoteController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [NoteController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [NoteController::class, 'document'])->name('document'); // List of documents like slips
    });
});
