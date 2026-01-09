<?php

use Illuminate\Support\Facades\Route;
use Modules\Vendor\Http\Controllers\VendorApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'vendors',
            VendorApiController::class
        )->names('vendors');
    });
