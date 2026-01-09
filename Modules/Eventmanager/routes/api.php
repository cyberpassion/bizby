<?php

use Illuminate\Support\Facades\Route;
use Modules\Eventmanager\Http\Controllers\EventmanagerApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'eventmanagers',
            EventmanagerApiController::class
        )->names('eventmanagers');
    });
