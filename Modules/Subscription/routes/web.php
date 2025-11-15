<?php

use Illuminate\Support\Facades\Route;
use Modules\Subscription\Http\Controllers\SubscriptionController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('subscriptions', SubscriptionController::class)->names('subscription');
	// Custom Routes
    Route::prefix('subscription')->name('subscription.')->group(function () {
        Route::get('home', [SubscriptionController::class, 'home'])->name('home');
        Route::get('list', [SubscriptionController::class, 'list'])->name('list');
        Route::get('report', [SubscriptionController::class, 'report'])->name('report');
        Route::get('settings', [SubscriptionController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [SubscriptionController::class, 'view'])->name('view');
        Route::get('{id}/edit', [SubscriptionController::class, 'edit'])->name('edit');
    });
});
