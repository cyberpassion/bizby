<?php

use Illuminate\Support\Facades\Route;
use Modules\ConsumptionManagement\Http\Controllers\ConsumptionManagementApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::prefix('consumptions')->name('consumptions.')->group(function () {
            Route::get('stats', [ConsumptionManagementApiController::class, 'stats'])->name('stats');
            Route::get('graphs', [ConsumptionManagementApiController::class, 'graphs'])->name('graphs');
        });

        Route::apiResource(
            'consumptions',
            ConsumptionManagementApiController::class
        )->names('consumptions');

		Route::get('consumptions/stock', [ConsumptionManagementApiController::class, 'stockSummary']);
    });