<?php

use Illuminate\Support\Facades\Route;
use Modules\Survey\Http\Controllers\SurveyApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'surveys',
            SurveyApiController::class
        )->names('surveys');
    });
