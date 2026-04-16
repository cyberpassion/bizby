<?php

use Illuminate\Support\Facades\Route;
use Modules\Employee\Http\Controllers\EmployeeApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

		Route::prefix('employees')->name('employees.')->group(function () {
            Route::get('stats', [EmployeeApiController::class, 'stats'])->name('stats');
            Route::get('graphs', [EmployeeApiController::class, 'graphs'])->name('graphs');
        });

        Route::apiResource(
            'employees',
            EmployeeApiController::class
        )->names('employees');

    });
