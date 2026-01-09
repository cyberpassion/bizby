<?php

use Illuminate\Support\Facades\Route;
use Modules\Vendor\Http\Controllers\VendorApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('vendors', VendorController::class)->names('vendor');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('vendors', VendorApiController::class)->names('vendors');
});
