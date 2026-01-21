<?php

use Illuminate\Support\Facades\Route;
use Modules\Attendance\Http\Controllers\AttendanceSessionApiController;
use Modules\Attendance\Http\Controllers\AttendanceApiController;
use Modules\Attendance\Http\Controllers\AttendanceReportApiController;

/*
|--------------------------------------------------------------------------
| Attendance Module API Routes (SaaS / Multi-tenant)
|--------------------------------------------------------------------------
| All routes are:
| - Versioned (v1)
| - Protected by Sanctum authentication
| - Tenant-aware (multi-company SaaS)
|--------------------------------------------------------------------------
*/

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Attendance Sessions (Shift / Class / Event)
        |--------------------------------------------------------------------------
        | A session represents a scheduled attendance event
        | Example: Office shift, class, training, meeting
        |--------------------------------------------------------------------------
        */

        // List all attendance sessions for tenant
        // Used by admin/HR to view sessions
        Route::get(
            'attendance/sessions',
            [AttendanceSessionApiController::class, 'index']
        );

        // Create a new attendance session
        // Used by admin/HR to create shifts or classes
        Route::post(
            'attendance/sessions',
            [AttendanceSessionApiController::class, 'store']
        );

        // View a single attendance session
        // Used when marking attendance or viewing details
        Route::get(
            'attendance/sessions/{sessionId}',
            [AttendanceSessionApiController::class, 'show']
        );

        /*
        |--------------------------------------------------------------------------
        | Attendance Marking & Punching
        |--------------------------------------------------------------------------
        | Handles manual attendance, bulk marking,
        | admin punch, and self punch (employee/student)
        |--------------------------------------------------------------------------
        */

        Route::prefix('attendance')->group(function () {

            // Mark attendance for a single user in a session
            // Example: Teacher marks one student present
            Route::post(
                'sessions/{sessionId}/mark',
                [AttendanceApiController::class, 'mark']
            );

            // Bulk mark attendance for a session
            // Example: HR marks whole department attendance
            Route::post(
                'sessions/{sessionId}/bulk',
                [AttendanceApiController::class, 'bulk']
            );

            // Punch in/out for a specific attendance record (admin/system)
            // Example: Biometric, QR, RFID, admin correction
            Route::post(
                '{attendanceId}/punch',
                [AttendanceApiController::class, 'punch']
            );

            // Self punch in/out by logged-in user
            // Example: Employee uses mobile app to punch
            Route::post(
                'self/punch',
                [AttendanceApiController::class, 'selfPunch']
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Attendance Reports
        |--------------------------------------------------------------------------
        | Reporting APIs for HR, admin, payroll, analytics
        |--------------------------------------------------------------------------
        */

        Route::prefix('attendance/reports')->group(function () {

            // Daily attendance report
            // Shows present/absent/late users for a date
            Route::get(
                'daily',
                [AttendanceReportApiController::class, 'daily']
            );

            // Monthly attendance summary
            // Used for payroll and performance tracking
            Route::get(
                'monthly',
                [AttendanceReportApiController::class, 'monthly']
            );

            // Entity-based attendance report
            // Example: department, branch, class, team, project
            Route::get(
                'entity/{type}/{id}',
                [AttendanceReportApiController::class, 'entity']
            );
        });
    });
