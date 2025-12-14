<?php

use Illuminate\Support\Facades\Route;

use Modules\Student\Http\Controllers\StudentApiController;
use Modules\Student\Http\Controllers\StudentAcademicYearApiController;

Route::prefix('v1')->group(function () {

    // ------------------------------------
    // Students CRUD
    // ------------------------------------
    Route::apiResource('students', StudentApiController::class)->names('students');

	// Academic Years
	Route::prefix('students')->group(function () {
    	Route::apiResource('academic-years', StudentAcademicYearApiController::class)->names('students.academicYears');
	});

});
