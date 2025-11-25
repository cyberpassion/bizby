<?php

use Illuminate\Support\Facades\Route;
use Modules\Examresult\Http\Controllers\ExamresultController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('examresult', ExamresultController::class)->names('examresult');
	// Custom Routes
    Route::prefix('examresult')->name('examresult.')->group(function () {
        Route::get('/list', [ExamresultController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [ExamresultController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [ExamresultController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [ExamresultController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [ExamresultController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [ExamresultController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [ExamresultController::class, 'document'])->name('document'); // List of documents like slips
    });
});
