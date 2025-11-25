<?php

use Illuminate\Support\Facades\Route;
use Modules\Leaveapplication\Http\Controllers\LeaveapplicationController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('leaveapplications', LeaveapplicationController::class)->names('leaveapplication');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('leaveapplications', LeaveapplicationApiController::class)->names('leaveapplications');
});


