<?php

use Illuminate\Support\Facades\Route;
use Modules\Transport\Http\Controllers\TransportApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'transports',
            TransportApiController::class
        )->names('transports');
    });

