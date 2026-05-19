<?php

use Illuminate\Support\Facades\Route;
use Modules\Employee\Http\Controllers\EmployeeApiController;
use Modules\Employee\Http\Controllers\EmployeeEducationHistoryApiController;
use Modules\Employee\Http\Controllers\EmployeeWorkHistoryApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::prefix('employees')->name('employees.')->group(function () {

            Route::get(
                'stats',
                [EmployeeApiController::class, 'stats']
            )->name('stats');

            Route::get(
                'graphs',
                [EmployeeApiController::class, 'graphs']
            )->name('graphs');
        });

        /*
        |--------------------------------------------------------------------------
        | EMPLOYEES
        |--------------------------------------------------------------------------
        */

        Route::apiResource(
            'employees',
            EmployeeApiController::class
        )->names('employees');

        /*
        |--------------------------------------------------------------------------
        | WORK HISTORIES
        |--------------------------------------------------------------------------
        */

        Route::apiResource(
            'employees/{employee}/work-histories',
            EmployeeWorkHistoryApiController::class
        )->names('employees.workHistories');

        /*
        |--------------------------------------------------------------------------
        | EDUCATION HISTORIES
        |--------------------------------------------------------------------------
        */

        Route::apiResource(
            'employees/{employee}/education-histories',
            EmployeeEducationHistoryApiController::class
        )->names('employees.educationHistories');

    });
