<?php

use Illuminate\Support\Facades\Route;
use Modules\Leaveapplication\Http\Controllers\LeaveapplicationController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('leaveapplications', LeaveapplicationController::class)->names('leaveapplication');
	// Custom Routes
    Route::prefix('leaveapplication')->name('leaveapplication.')->group(function () {
        Route::get('home', [LeaveapplicationController::class, 'home'])->name('home');
        Route::get('list', [LeaveapplicationController::class, 'list'])->name('list');
        Route::get('report', [LeaveapplicationController::class, 'report'])->name('report');
        Route::get('settings', [LeaveapplicationController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [LeaveapplicationController::class, 'view'])->name('view');
        Route::get('{id}/edit', [LeaveapplicationController::class, 'edit'])->name('edit');
    });
});
