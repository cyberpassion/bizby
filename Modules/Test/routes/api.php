<?php

use Illuminate\Support\Facades\Route;
use Modules\Test\Http\Controllers\TestApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'tests',
            TestApiController::class
        )->names('tests');
    });
