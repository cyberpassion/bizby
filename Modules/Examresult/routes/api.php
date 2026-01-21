<?php

use Illuminate\Support\Facades\Route;
use Modules\Examresult\Http\Controllers\ExamresultEvaluationApiController;
use Modules\Examresult\Http\Controllers\ExamresultResultApiController;
use Modules\Examresult\Http\Controllers\ExamresultComponentApiController;
use Modules\Examresult\Http\Controllers\ExamresultReportApiController;

Route::prefix('v1/examresults')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Evaluations (Exams / Tests)
        |--------------------------------------------------------------------------
        | Admin creates and manages exams
        |--------------------------------------------------------------------------
        */

        Route::get('/evaluations', [ExamresultEvaluationApiController::class, 'index']);
        Route::get('/evaluations/{id}', [ExamresultEvaluationApiController::class, 'show']);
        Route::post('/evaluations', [ExamresultEvaluationApiController::class, 'store']);
        Route::put('/evaluations/{id}', [ExamresultEvaluationApiController::class, 'update']);
        Route::delete('/evaluations/{id}', [ExamresultEvaluationApiController::class, 'destroy']);

        /*
        |--------------------------------------------------------------------------
        | Evaluation Components (Subjects / Papers / Sections)
        |--------------------------------------------------------------------------
        */

        Route::post('/evaluations/{id}/components', [ExamresultComponentApiController::class, 'store']);
        Route::put('/components/{id}', [ExamresultComponentApiController::class, 'update']);
        Route::delete('/components/{id}', [ExamresultComponentApiController::class, 'destroy']);

        /*
        |--------------------------------------------------------------------------
        | Results Entry
        |--------------------------------------------------------------------------
        | Teachers / evaluators enter marks
        |--------------------------------------------------------------------------
        */

        Route::post('/results', [ExamresultResultApiController::class, 'store']);
        Route::post('/results/bulk', [ExamresultResultApiController::class, 'bulkStore']);

        Route::get('/results/evaluation/{id}', [ExamresultResultApiController::class, 'evaluationResults']);
        Route::get('/results/group', [ExamresultResultApiController::class, 'groupResults']);

        /*
        |--------------------------------------------------------------------------
        | Reports (Read-only, Aggregated)
        |--------------------------------------------------------------------------
        */

        Route::prefix('reports')->group(function () {

            // Student marksheet
            Route::get('/student/{id}', [ExamresultReportApiController::class, 'student']);

            // Evaluation summary (totals, ranks)
            Route::get('/evaluation/{id}/summary', [ExamresultReportApiController::class, 'evaluationSummary']);

            // Top performers
            Route::get('/evaluation/{id}/top', [ExamresultReportApiController::class, 'topPerformers']);

            // Entity report (class / batch / section)
            Route::get('/entity/{type}/{id}', [ExamresultReportApiController::class, 'entity']);

            // Progress report (multi-exam)
            Route::get('/progress', [ExamresultReportApiController::class, 'progress']);
        });

        /*
        |--------------------------------------------------------------------------
        | Import / Export
        |--------------------------------------------------------------------------
        */

        Route::post('/import', [ExamresultResultApiController::class, 'import']);
        Route::get('/export', [ExamresultResultApiController::class, 'export']);

        /*
        |--------------------------------------------------------------------------
        | System / Admin Actions
        |--------------------------------------------------------------------------
        */

        // Lock evaluation after publish
        Route::post('/evaluations/{id}/lock', [ExamresultEvaluationApiController::class, 'lock']);

        // Recalculate grades & ranks
        Route::post('/evaluations/{id}/recalculate', [ExamresultEvaluationApiController::class, 'recalculate']);
    });
