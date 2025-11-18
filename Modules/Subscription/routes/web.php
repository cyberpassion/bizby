<?php

use Illuminate\Support\Facades\Route;
use Modules\Subscription\Http\Controllers\SubscriptionController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('subscription', SubscriptionController::class)->names('subscription');
	// Custom Routes
    Route::prefix('subscription')->name('subscription.')->group(function () {
        Route::get('/list', [SubscriptionController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
	    Route::get('/report', [SubscriptionController::class, 'report'])->name('report'); // Report page
    	Route::get('/settings', [SubscriptionController::class, 'settings'])->name('settings'); // Settings page
	    Route::post('{id}/profile', [SubscriptionController::class, 'profile'])->name('profile'); // Profile Page
		Route::post('{id}/restore', [SubscriptionController::class, 'restore'])->name('restore'); // Restore Page (opposite of destroy)
    	Route::get('{id}/documents', [SubscriptionController::class, 'document'])->name('document'); // List of documents like slips
		Route::get('{id}/document/{$name}', [SubscriptionController::class, 'document'])->name('document'); // List of documents like slips
    });
});
