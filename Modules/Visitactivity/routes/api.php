<?php

use Illuminate\Support\Facades\Route;
use Modules\Visitactivity\Http\Controllers\VisitactivityController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('visitactivities', VisitactivityController::class)->names('visitactivity');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('visitactivitys', VisitactivityApiController::class)->names('visitactivity');
});
