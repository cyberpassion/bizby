<?php

use Illuminate\Support\Facades\Route;
use Modules\Examresult\Http\Controllers\ExamresultController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('examresults', ExamresultController::class)->names('examresult');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('examresults', ExamresultApiController::class)->names('examresluts');
});
