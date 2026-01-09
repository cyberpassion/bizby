<?php

use Illuminate\Support\Facades\Route;
use Modules\Visitactivity\Http\Controllers\VisitactivityApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'visitactivities',
            VisitactivityApiController::class
        )->names('visitactivities');
    });
