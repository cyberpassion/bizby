<?php

use Illuminate\Support\Facades\Route;
use Modules\Signup\Http\Controllers\SignupController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('signups', SignupController::class)->names('signup');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('signups', SignupApiController::class)->names('signups');
});
