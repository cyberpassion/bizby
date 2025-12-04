<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\StudentApiController;

use App\Http\Controllers\Api\StudentFeeController;
use App\Http\Controllers\Api\FeeHeadController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('students', StudentController::class)->names('student');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('students', StudentApiController::class)->names('students');

	/**
     * Nested Fee Routes
     * /v1/students/{student}/fee/*
     */
    Route::prefix('students/{student}/fee')->group(function () {

        // GET all fee entries for student
        Route::get('/', [StudentFeeController::class, 'index'])
            ->name('students.fee.index');

        // Add/create fee entry
        Route::post('/', [StudentFeeController::class, 'store'])
            ->name('students.fee.store');

        // Generate fee for this student
        Route::post('/generate', [StudentFeeController::class, 'generateForStudent'])
            ->name('students.fee.generate');

        // GET payment history for student
        /*Route::get('/payment', [StudentFeePaymentController::class, 'index'])
            ->name('students.fee.payment.index');

        // Make payment
        Route::post('/payment', [StudentFeePaymentController::class, 'store'])
            ->name('students.fee.payment.store');*/
    });


    /**
     * Global Fee Routes (Not student-specific)
     */
    Route::prefix('fee')->group(function () {

        Route::apiResource('head', FeeHeadController::class)->names('fee.head');

        Route::apiResource('structure', FeeStructureController::class)->names('fee.structure');

        // Generate fees for ALL students
        Route::post('generate-all', [StudentFeeController::class, 'generateForAll'])
            ->name('fee.generate.all');

    });

});
