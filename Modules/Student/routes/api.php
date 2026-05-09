<?php

use Illuminate\Support\Facades\Route;

use Modules\Student\Http\Controllers\StudentApiController;
use Modules\Student\Http\Controllers\StudentAcademicYearApiController;
use Modules\Student\Http\Controllers\StudentFeeStructureApiController;
use Modules\Student\Http\Controllers\StudentFeeStructureOverrideApiController;
use Modules\Student\Http\Controllers\StudentFeeSummaryApiController;
use Modules\Student\Http\Controllers\StudentFeeSubmissionApiController;
use Modules\Student\Http\Controllers\StudentTransitionApiController;

// Reports
use Modules\Student\Http\Controllers\Reports\StudentReportApiController;
use Modules\Student\Http\Controllers\Reports\StudentFeeCollectionReportApiController;
use Modules\Student\Http\Controllers\Reports\StudentFeeDueReportApiController;
use Modules\Student\Http\Controllers\Reports\StudentFeeDefaulterReportApiController;
use Modules\Student\Http\Controllers\Reports\StudentFeeDiscountReportApiController;
use Modules\Student\Http\Controllers\Reports\StudentFeeLedgerReportApiController;
use Modules\Student\Http\Controllers\Reports\StudentStrengthReportApiController;
use Modules\Student\Http\Controllers\Reports\StudentAdmissionReportApiController;
use Modules\Student\Http\Controllers\Reports\StudentTransitionReportApiController;

// Analytics
use Modules\Student\Http\Controllers\Analytics\StudentAnalyticsApiController;
use Modules\Student\Http\Controllers\Analytics\StudentFeeAnalyticsApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::prefix('students')->name('students.')->group(function () {

            Route::get('stats', [StudentApiController::class, 'stats'])
                ->name('stats');

            Route::get('graphs', [StudentApiController::class, 'graphs'])
                ->name('graphs');
        });

		/*
        |--------------------------------------------------------------------------
        | ACADEMIC YEARS
        |--------------------------------------------------------------------------
        */

        Route::apiResource(
            'students/academic-years',
            StudentAcademicYearApiController::class
        )->names('students.academicYears');

		/*
        |--------------------------------------------------------------------------
        | FEE STRUCTURES
        |--------------------------------------------------------------------------
        */

        Route::apiResource(
            'students/fee-structures',
            StudentFeeStructureApiController::class
        )->names('students.feeStructures');

        /*
        |--------------------------------------------------------------------------
        | FEE STRUCTURE OVERRIDES
        |--------------------------------------------------------------------------
        */

        Route::apiResource(
            'students/{id}/fee-structure-overrides',
            StudentFeeStructureOverrideApiController::class
        )->names('students.feeStructureOverrides');

        /*
        |--------------------------------------------------------------------------
        | STUDENTS CRUD
        |--------------------------------------------------------------------------
        */

        Route::apiResource('students', StudentApiController::class)
            ->names('students');

        /*
|--------------------------------------------------------------------------
| STUDENT TRANSITIONS
|--------------------------------------------------------------------------
|
| Handles:
| - Promotions
| - Demotions
| - Transfers
| - Retain / Repeat
| - Graduations
|
*/

Route::prefix('students/transitions')
    ->name('students.transitions.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Listing / History
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/',
            [StudentTransitionApiController::class, 'index']
        )->name('index');

        /*
        |--------------------------------------------------------------------------
        | Create Transition Batch
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/',
            [StudentTransitionApiController::class, 'store']
        )->name('store');

        /*
        |--------------------------------------------------------------------------
        | Preview Before Processing
        |--------------------------------------------------------------------------
        */

        Route::post(
            'preview',
            [StudentTransitionApiController::class, 'preview']
        )->name('preview');

        /*
        |--------------------------------------------------------------------------
        | Validate Transition Rules
        |--------------------------------------------------------------------------
        */

        Route::post(
            'validate',
            [StudentTransitionApiController::class, 'validateTransition']
        )->name('validate');

        /*
        |--------------------------------------------------------------------------
        | Process Transition
        |--------------------------------------------------------------------------
        */

        Route::post(
            '{id}/process',
            [StudentTransitionApiController::class, 'process']
        )->name('process');

        /*
        |--------------------------------------------------------------------------
        | Rollback Transition
        |--------------------------------------------------------------------------
        */

        Route::post(
            '{id}/rollback',
            [StudentTransitionApiController::class, 'rollback']
        )->name('rollback');

        /*
        |--------------------------------------------------------------------------
        | Transition Detail
        |--------------------------------------------------------------------------
        */

        Route::get(
            '{id}',
            [StudentTransitionApiController::class, 'show']
        )->name('show');

        /*
        |--------------------------------------------------------------------------
        | Transition Students
        |--------------------------------------------------------------------------
        */

        Route::get(
            '{id}/students',
            [StudentTransitionApiController::class, 'students']
        )->name('students');

        /*
        |--------------------------------------------------------------------------
        | Failed / Skipped Students
        |--------------------------------------------------------------------------
        */

        Route::get(
            '{id}/failed',
            [StudentTransitionApiController::class, 'failed']
        )->name('failed');

        /*
        |--------------------------------------------------------------------------
        | Transition Logs / Audit
        |--------------------------------------------------------------------------
        */

        Route::get(
            '{id}/logs',
            [StudentTransitionApiController::class, 'logs']
        )->name('logs');

        /*
        |--------------------------------------------------------------------------
        | Summary / Stats
        |--------------------------------------------------------------------------
        */

        Route::get(
            '{id}/summary',
            [StudentTransitionApiController::class, 'summary']
        )->name('summary');

        /*
        |--------------------------------------------------------------------------
        | Download Report
        |--------------------------------------------------------------------------
        */

        Route::get(
            '{id}/export',
            [StudentTransitionApiController::class, 'export']
        )->name('export');

        /*
        |--------------------------------------------------------------------------
        | Bulk Promotion Shortcut
        |--------------------------------------------------------------------------
        */

        Route::post(
            'bulk-promotion',
            [StudentTransitionApiController::class, 'bulkPromotion']
        )->name('bulkPromotion');

        /*
        |--------------------------------------------------------------------------
        | Selective Promotion Shortcut
        |--------------------------------------------------------------------------
        */

        Route::post(
            'selective-promotion',
            [StudentTransitionApiController::class, 'selectivePromotion']
        )->name('selectivePromotion');

        /*
        |--------------------------------------------------------------------------
        | Transfer Shortcut
        |--------------------------------------------------------------------------
        */

        Route::post(
            'transfer',
            [StudentTransitionApiController::class, 'transfer']
        )->name('transfer');

        /*
        |--------------------------------------------------------------------------
        | Demotion Shortcut
        |--------------------------------------------------------------------------
        */

        Route::post(
            'demotion',
            [StudentTransitionApiController::class, 'demotion']
        )->name('demotion');

        /*
        |--------------------------------------------------------------------------
        | Retain / Repeat Year
        |--------------------------------------------------------------------------
        */

        Route::post(
            'retain',
            [StudentTransitionApiController::class, 'retain']
        )->name('retain');

        /*
        |--------------------------------------------------------------------------
        | Graduate Students
        |--------------------------------------------------------------------------
        */

        Route::post(
            'graduate',
            [StudentTransitionApiController::class, 'graduate']
        )->name('graduate');
    });

        /*
        |--------------------------------------------------------------------------
        | STUDENT FEE SUMMARY
        |--------------------------------------------------------------------------
        */

        Route::get(
            'students/{id}/fee-summary',
            [StudentFeeSummaryApiController::class, 'show']
        );

        /*
        |--------------------------------------------------------------------------
        | FEE SUBMISSIONS / PAYMENTS
        |--------------------------------------------------------------------------
        */

        Route::post(
            'students/{id}/fee-submissions',
            [StudentFeeSubmissionApiController::class, 'store']
        );

        /*
        |--------------------------------------------------------------------------
        | REPORTS
        |--------------------------------------------------------------------------
        */

        Route::prefix('students/reports')->group(function () {

			Route::get(
    		    'students',
        		[StudentReportApiController::class, 'index']
    		);

            /*
            |--------------------------------------------------------------------------
            | Fee Reports
            |--------------------------------------------------------------------------
            */

            Route::prefix('fees')->group(function () {

                Route::get(
                    'collections',
                    [StudentFeeCollectionReportApiController::class, 'index']
                );

                Route::get(
                    'daily-collections',
                    [StudentFeeCollectionReportApiController::class, 'daily']
                );

                Route::get(
                    'head-wise',
                    [StudentFeeCollectionReportApiController::class, 'headWise']
                );

                Route::get(
                    'dues',
                    [StudentFeeDueReportApiController::class, 'index']
                );

                Route::get(
                    'defaulters',
                    [StudentFeeDefaulterReportApiController::class, 'index']
                );

                Route::get(
                    'discounts',
                    [StudentFeeDiscountReportApiController::class, 'index']
                );
            });

            /*
            |--------------------------------------------------------------------------
            | Student Reports
            |--------------------------------------------------------------------------
            */

            Route::prefix('students')->group(function () {

                Route::get(
                    '{id}/fee-ledger',
                    [StudentFeeLedgerReportApiController::class, 'show']
                );

                Route::get(
                    'strength',
                    [StudentStrengthReportApiController::class, 'index']
                );

                Route::get(
                    'admissions',
                    [StudentAdmissionReportApiController::class, 'index']
                );

                Route::get(
                    'promotions',
                    [StudentTransitionReportApiController::class, 'index']
                );

                Route::get(
                    '{id}/academic-history',
                    [StudentTransitionReportApiController::class, 'academicHistory']
                );
            });
        });

        /*
        |--------------------------------------------------------------------------
        | ANALYTICS
        |--------------------------------------------------------------------------
        */

        Route::prefix('students/analytics')->group(function () {

            /*
            |--------------------------------------------------------------------------
            | Fee Analytics
            |--------------------------------------------------------------------------
            */

            Route::prefix('fees')->group(function () {

                Route::get(
                    'summary',
                    [StudentFeeAnalyticsApiController::class, 'summary']
                );

                Route::get(
                    'trends',
                    [StudentFeeAnalyticsApiController::class, 'trends']
                );

                Route::get(
                    'collection-vs-due',
                    [StudentFeeAnalyticsApiController::class, 'collectionVsDue']
                );
            });

            /*
            |--------------------------------------------------------------------------
            | Student Analytics
            |--------------------------------------------------------------------------
            */

            Route::prefix('students')->group(function () {

                Route::get(
                    'growth',
                    [StudentAnalyticsApiController::class, 'growth']
                );

                Route::get(
                    'gender-distribution',
                    [StudentAnalyticsApiController::class, 'genderDistribution']
                );

                Route::get(
                    'class-distribution',
                    [StudentAnalyticsApiController::class, 'classDistribution']
                );
            });
        });
    });