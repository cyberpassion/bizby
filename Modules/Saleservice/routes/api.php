<?php

use Illuminate\Support\Facades\Route;
use Modules\Saleservice\Http\Controllers\SaleserviceApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'saleservices',
            SaleserviceApiController::class
        )->names('saleservices');
    });
