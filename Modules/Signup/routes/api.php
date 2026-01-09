<?php

use Illuminate\Support\Facades\Route;
use Modules\Signup\Http\Controllers\SignupApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'signups',
            SignupApiController::class
        )->names('signups');
    });
