<?php

use Illuminate\Support\Facades\Route;
use Modules\Visitplanner\Http\Controllers\VisitplannerApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('visitplanners', VisitplannerController::class)->names('visitplanner');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('visitplanners', VisitplannerApiController::class)->names('visitplanners');
});
