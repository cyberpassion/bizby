<?php

use Illuminate\Support\Facades\Route;
use Modules\Visitplanner\Http\Controllers\VisitplannerApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'visitplanners',
            VisitplannerApiController::class
        )->names('visitplanners');
    });
