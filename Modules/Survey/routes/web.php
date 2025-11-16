<?php

use Illuminate\Support\Facades\Route;
use Modules\Survey\Http\Controllers\SurveyController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('survey', SurveyController::class)->names('survey');
	// Custom Routes
    Route::prefix('survey')->name('survey.')->group(function () {
        Route::get('/list', [SurveyController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [SurveyController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [SurveyController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [SurveyController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [SurveyController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [SurveyController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [SurveyController::class, 'document'])->name('document'); // List of documents like slips
    });
});
