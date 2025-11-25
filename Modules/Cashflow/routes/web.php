<?php

use Illuminate\Support\Facades\Route;
use Modules\Cashflow\Http\Controllers\CashflowController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('cashflow', CashflowController::class)->names('cashflow');
	// Custom Routes
    Route::prefix('cashflow')->name('cashflow.')->group(function () {
        Route::get('/list', [CashflowController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [CashflowController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [CashflowController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [CashflowController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [CashflowController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [CashflowController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [CashflowController::class, 'document'])->name('document'); // List of documents like slips
    });
});