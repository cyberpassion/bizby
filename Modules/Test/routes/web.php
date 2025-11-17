<?php

use Illuminate\Support\Facades\Route;
use Modules\Test\Http\Controllers\TestController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('test', TestController::class)->names('test');
	// Custom Routes
    Route::prefix('test')->name('test.')->group(function () {
        Route::get('/list', [TestController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [TestController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [TestController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [TestController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [TestController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [TestController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [TestController::class, 'document'])->name('document'); // List of documents like slips
    });
});
