<?php

use Illuminate\Support\Facades\Route;
use Modules\Patient\Http\Controllers\PatientApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patients', PatientController::class)->names('patient');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('patients', PatientApiController::class)->names('patients');
});
