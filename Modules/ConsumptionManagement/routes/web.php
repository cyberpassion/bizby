<?php

use Illuminate\Support\Facades\Route;
use Modules\ConsumptionManagement\Http\Controllers\ConsumptionManagementController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('consumptionmanagements', ConsumptionManagementController::class)->names('consumptionmanagement');
	// Custom Routes
    Route::prefix('consumptionmanagement')->name('consumptionmanagement.')->group(function () {
        Route::get('home', [ConsumptionManagementController::class, 'home'])->name('home');
        Route::get('list', [ConsumptionManagementController::class, 'list'])->name('list');
        Route::get('report', [ConsumptionManagementController::class, 'report'])->name('report');
        Route::get('settings', [ConsumptionManagementController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [ConsumptionManagementController::class, 'view'])->name('view');
        Route::get('{id}/edit', [ConsumptionManagementController::class, 'edit'])->name('edit');
    });
});
