<?php

use Illuminate\Support\Facades\Route;
use Modules\Treatment\Http\Controllers\TreatmentApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'treatments',
            TreatmentApiController::class
        )->names('treatments');
    });
