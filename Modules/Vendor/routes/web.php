<?php

use Illuminate\Support\Facades\Route;
use Modules\Vendor\Http\Controllers\VendorController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('vendor', VendorController::class)->names('vendor');
	// Custom Routes
    Route::prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/list', [VendorController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [VendorController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [VendorController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [VendorController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [VendorController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [VendorController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [VendorController::class, 'document'])->name('document'); // List of documents like slips
    });
});