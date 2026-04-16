<?php

use Illuminate\Support\Facades\Route;
use Modules\Maintenance\Http\Controllers\MaintenanceApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::prefix('maintenances')->name('maintenances.')->group(function () {
            Route::get('stats', [MaintenanceApiController::class, 'stats'])->name('stats');
            Route::get('graphs', [MaintenanceApiController::class, 'graphs'])->name('graphs');
        });

        Route::apiResource(
            'maintenances',
            MaintenanceApiController::class
        )->names('maintenances');
    });