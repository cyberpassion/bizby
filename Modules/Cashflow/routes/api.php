<?php

use Illuminate\Support\Facades\Route;
use Modules\Cashflow\Http\Controllers\CashflowApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'cashflows',
            CashflowApiController::class
        );
    });
