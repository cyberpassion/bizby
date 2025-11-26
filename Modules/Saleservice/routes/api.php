<?php

use Illuminate\Support\Facades\Route;
use Modules\Saleservice\Http\Controllers\SaleserviceController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('saleservices', SaleserviceController::class)->names('saleservice');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('saleservices', SaleserviceApiController::class)->names('saleservices');
});
