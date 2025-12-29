<?php

use Illuminate\Support\Facades\Route;
use Modules\Cashflow\Http\Controllers\CashflowApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('cashflows', CashflowController::class)->names('cashflow');
});*/


// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {

    Route::apiResource(
        'cashflows',
        CashflowApiController::class
    );
});
