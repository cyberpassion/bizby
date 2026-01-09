<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\ServiceApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'services',
            ServiceApiController::class
        )->names('services');
    });
