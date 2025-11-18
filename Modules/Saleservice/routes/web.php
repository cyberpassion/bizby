<?php

use Illuminate\Support\Facades\Route;
use Modules\Saleservice\Http\Controllers\SaleserviceController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('saleservice', SaleserviceController::class)->names('saleservice');
	// Custom Routes
    Route::prefix('saleservice')->name('saleservice.')->group(function () {
        Route::get('/list', [SaleserviceController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [SaleserviceController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [SaleserviceController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [SaleserviceController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [SaleserviceController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [SaleserviceController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [SaleserviceController::class, 'document'])->name('document'); // List of documents like slips
    });
});