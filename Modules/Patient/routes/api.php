<?php

use Illuminate\Support\Facades\Route;
use Modules\Patient\Http\Controllers\PatientApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'patients',
            PatientApiController::class
        )->names('patients');
    });
