<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\CustomerApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('customers', CustomerController::class)->names('customer');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('customers', CustomerApiController::class)->names('customers');
});
