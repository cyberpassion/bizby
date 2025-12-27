<?php

use Illuminate\Support\Facades\Route;
use Modules\Examresult\Http\Controllers\ExamresultEvaluationApiController;
use Modules\Examresult\Http\Controllers\ExamresultResultApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('examresults', ExamresultController::class)->names('examresult');
});*/

// Temporarily disable auth middleware
Route::prefix('v1/examresults')->group(function () {

    Route::get('/evaluations', [ExamresultEvaluationApiController::class, 'index']);
    Route::get('/evaluations/{id}', [ExamresultEvaluationApiController::class, 'show']);

    Route::get('/results/evaluation/{id}', [ExamresultResultApiController::class, 'evaluationResults']);
    Route::get('/results/group', [ExamresultResultApiController::class, 'groupResults']);
});
