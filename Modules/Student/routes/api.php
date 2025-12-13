<?php

use Illuminate\Support\Facades\Route;

use Modules\Student\Http\Controllers\AcademicLevelApiController;
use Modules\Student\Http\Controllers\StudentApiController;
use Modules\Student\Http\Controllers\StudentFeeApiController;
use Modules\Student\Http\Controllers\StudentFeeHeadApiController;
use Modules\Student\Http\Controllers\StudentFeeStructureApiController;
use Modules\Student\Http\Controllers\StudentOptionalFeeApiController;
use Modules\Student\Http\Controllers\StudentFeeTransactionApiController;
use Modules\Student\Http\Controllers\StudentClassHistoryApiController;

Route::prefix('v1')->group(function () {

    // ------------------------------------
    // Students CRUD
    // ------------------------------------
    Route::apiResource('students', StudentApiController::class)->names('students');

	// -------------------------------------------
	// Academic Levels & Types CRUD
	// -------------------------------------------
	// ------------------------------------
    // Academic Levels CRUD
    // /v1/academic-levels/*
    // ------------------------------------
    Route::apiResource('academic-levels', AcademicLevelApiController::class)->names('academic.levels');
	// Get classwide dues report
    Route::get('academic-levels/{academic_level}/dues', [StudentFeeApiController::class, 'classDuesReport'])
            ->name('students.fee.classDuesReport');

    // ------------------------------------
    // Nested Student Fee Routes
    // /v1/students/{student}/fee/*
    // ------------------------------------
    Route::prefix('students/{student}/fee')->group(function () {

        // List all fees for this student
        Route::get('/', [StudentFeeApiController::class, 'index'])
            ->name('students.fee.index');

        // Cancel a specific fee entry
        Route::post('/{fee}/cancel', [StudentFeeApiController::class, 'cancel'])
            ->name('students.fee.cancel');

        // Generate fees for this student
        Route::post('/generate', [StudentFeeApiController::class, 'generateForStudent'])
            ->name('students.fee.generate');

        // Dues calculation for this student
        Route::get('/dues', [StudentFeeApiController::class, 'dues'])
            ->name('students.fee.dues');

        // Generate invoice for this student
        Route::get('/invoice', [StudentFeeApiController::class, 'invoice'])
            ->name('students.fee.invoice');

        // Make a payment for fee items
        Route::post('/payment', [StudentFeeTransactionApiController::class, 'storeForStudent'])
            ->name('students.fee.payment');
    });


    // ------------------------------------
    // Global Fee Routes
    // ------------------------------------
    Route::prefix('students/fee')->group(function () {

        // Fee Heads CRUD
        Route::apiResource('heads', StudentFeeHeadApiController::class)
            ->names('fee.heads');

        // Fee Structure CRUD
        Route::apiResource('structure', StudentFeeStructureApiController::class)
            ->names('fee.structure');

        // Optional Fees CRUD
        Route::apiResource('optional', StudentOptionalFeeApiController::class)
            ->names('fee.optional');

        // Generate fees for ALL students
        Route::post('generate-all', [StudentFeeApiController::class, 'generateForAll'])
            ->name('fee.generate.all');

        // Global payments (not tied to specific student URL)
        Route::post('transactions', [StudentFeeTransactionApiController::class, 'store'])
            ->name('fee.transactions.store');
    });


    // ------------------------------------
    // Class History / Promotions
    // ------------------------------------
    Route::prefix('students/{student}/class-history')->group(function () {

        Route::get('/', [StudentClassHistoryApiController::class, 'index'])
            ->name('students.class-history.index');

        Route::post('/promote', [StudentClassHistoryApiController::class, 'promote'])
            ->name('students.class-history.promote');
    });

	Route::get('/students/fee/collection', [StudentFeeApiController::class, 'collectionReport'])->name('fee.collection.report');

});
