<?php

use Illuminate\Support\Facades\Route;
use Modules\Examresult\Http\Controllers\ExamresultEvaluationApiController;
use Modules\Examresult\Http\Controllers\ExamresultResultApiController;

Route::prefix('v1/examresults')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::get('/evaluations', [ExamresultEvaluationApiController::class, 'index']);
        Route::get('/evaluations/{id}', [ExamresultEvaluationApiController::class, 'show']);

        Route::get('/results/evaluation/{id}', [ExamresultResultApiController::class, 'evaluationResults']);
        Route::get('/results/group', [ExamresultResultApiController::class, 'groupResults']);
    });
