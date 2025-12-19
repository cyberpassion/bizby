<?php

use Illuminate\Support\Facades\Route;

use Modules\Student\Http\Controllers\StudentApiController;
use Modules\Student\Http\Controllers\StudentAcademicYearApiController;
use Modules\Student\Http\Controllers\StudentFeeStructureApiController;
use Modules\Student\Http\Controllers\StudentFeeStructureOverrideApiController;
use Modules\Student\Http\Controllers\StudentFeeSummaryApiController;
use Modules\Student\Http\Controllers\StudentFeeSubmissionApiController;

use Modules\Student\Http\Controllers\StudentFeeDuesApiController;
use Modules\Student\Http\Controllers\StudentFeeCollectionApiController;

use Modules\Student\Http\Controllers\StudentPromotionApiController;

Route::prefix('v1')->group(function () {

	// Academic Years
	Route::prefix('students')->group(function () {
    	Route::apiResource('academic-years', StudentAcademicYearApiController::class)->names('students.academicYears');
	});

	// Fee Structures
	Route::prefix('students')->group(function () {
    	Route::apiResource('fee-structures', StudentFeeStructureApiController::class)->names('students.feeStructures');
	});

	// Fee Structure Override
	Route::prefix('students')->group(function () {
    	Route::apiResource('{id}/fee-structure-overrides', StudentFeeStructureOverrideApiController::class)->names('students.feeSummary');
	});

	// Fee Summary for Student
	Route::get('students/{id}/fee-summary',[StudentFeeSummaryApiController::class, 'show']);

	// Fee Submission
	Route::post('students/{id}/fee-submissions', [StudentFeeSubmissionApiController::class, 'store']);

	// Fee Dues
	Route::prefix('students')->group(function () {
	    // Student-wise dues (single student)
    	Route::get('{id}/fee-dues', [StudentFeeDuesApiController::class,'show']);
	    // Class / section dues report
	    Route::get('fee-dues', [StudentFeeDuesApiController::class,'report']);
	});

	// Fee Collections
	Route::prefix('students')->group(function () {
	    // Single endpoint for fee collections / dues report
    	Route::get('fee-collections', [StudentFeeCollectionApiController::class, 'report']);
	});

	Route::prefix('students')->group(function () {
	    Route::get('promotions', [StudentPromotionApiController::class, 'index']);
    	Route::post('promotions', [StudentPromotionApiController::class, 'store']);
    	Route::get('promotions/{id}', [StudentPromotionApiController::class, 'show']);
	});

	// ------------------------------------
    // Students CRUD
    // ------------------------------------
    Route::apiResource('students', StudentApiController::class)->names('students');

});
