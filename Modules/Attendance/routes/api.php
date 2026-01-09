<?php

use Illuminate\Support\Facades\Route;
use Modules\Attendance\Http\Controllers\AttendanceSessionApiController;
use Modules\Attendance\Http\Controllers\AttendanceApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'attendance-sessions',
            AttendanceSessionApiController::class
        )->only(['index', 'store', 'show']);

        Route::post(
            'attendance-sessions/{attendanceSession}/attendances',
            [AttendanceApiController::class, 'store']
        );

        Route::apiResource(
            'attendances',
            AttendanceApiController::class
        )->only(['update', 'destroy']);
    });
