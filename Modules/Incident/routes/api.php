<?php

use Illuminate\Support\Facades\Route;
use Modules\Incident\Http\Controllers\IncidentApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::prefix('incidents')->name('incidents.')->group(function () {
            Route::get('stats', [IncidentApiController::class, 'stats'])->name('stats');
            Route::get('graphs', [IncidentApiController::class, 'graphs'])->name('graphs');
        });

        Route::apiResource(
            'incidents',
            IncidentApiController::class
        )->names('incidents');

		Route::get('incidents/by-center/{center_id}', [IncidentApiController::class, 'index']);
		Route::get('incidents/by-type/{type}', [IncidentApiController::class, 'index']);
    });