<?php

use Illuminate\Support\Facades\Route;
use Modules\Leaveapplication\Http\Controllers\LeaveapplicationApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('leaveapplications', LeaveapplicationController::class)->names('leaveapplication');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {

    Route::apiResource(
        'leaveapplications',
        LeaveapplicationApiController::class
    );

    Route::post(
        'leaveapplications/{leaveapplication}/approve',
        [LeaveapplicationApiController::class, 'approve']
    );

    Route::post(
        'leaveapplications/{leaveapplication}/reject',
        [LeaveapplicationApiController::class, 'reject']
    );
});
