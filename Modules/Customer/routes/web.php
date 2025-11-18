<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\CustomerController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('customer', CustomerController::class)->names('customer');
	// Custom Routes
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/list', [CustomerController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [CustomerController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [CustomerController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [CustomerController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [CustomerController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [CustomerController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [CustomerController::class, 'document'])->name('document'); // List of documents like slips
    });
});