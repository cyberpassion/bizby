<?php

use Illuminate\Support\Facades\Route;
use Modules\Leaveapplication\Http\Controllers\LeaveapplicationApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

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
