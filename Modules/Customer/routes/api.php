<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\CustomerApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'customers',
            CustomerApiController::class
        )->names('customers');
    });
