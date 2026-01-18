<?php

use Illuminate\Support\Facades\Route;
use Modules\Attendance\Http\Controllers\AttendanceSessionApiController;
use Modules\Attendance\Http\Controllers\AttendanceApiController;
use Modules\Attendance\Http\Controllers\AttendanceReportApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
		    'attendance/sessions',
		    AttendanceSessionApiController::class
		)->only(['index', 'store', 'show']);

        Route::prefix('attendance')->group(function () {

            Route::post(
                'sessions/{session}/mark',
                [AttendanceApiController::class, 'mark']
            );

            Route::post(
                'sessions/{session}/bulk',
                [AttendanceApiController::class, 'bulk']
            );

            Route::post(
                '{attendance}/punch',
                [AttendanceApiController::class, 'punch']
            );

            Route::post(
                'self/punch',
                [AttendanceApiController::class, 'selfPunch']
            );
        });

        Route::prefix('attendance/reports')->group(function () {
            Route::get('daily', [AttendanceReportApiController::class, 'daily']);
            Route::get('monthly', [AttendanceReportApiController::class, 'monthly']);
            Route::get('entity/{type}/{id}', [AttendanceReportApiController::class, 'entity']);
        });
    });
