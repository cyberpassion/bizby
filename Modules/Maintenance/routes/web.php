<?php

use Illuminate\Support\Facades\Route;
use Modules\Maintenance\Http\Controllers\MaintenanceController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('maintenances', MaintenanceController::class)->names('maintenance');
	// Custom Routes
    Route::prefix('maintenance')->name('maintenance.')->group(function () {
        Route::get('home', [MaintenanceController::class, 'home'])->name('home');
        Route::get('list', [MaintenanceController::class, 'list'])->name('list');
        Route::get('report', [MaintenanceController::class, 'report'])->name('report');
        Route::get('settings', [MaintenanceController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [MaintenanceController::class, 'view'])->name('view');
        Route::get('{id}/edit', [MaintenanceController::class, 'edit'])->name('edit');
    });
});
