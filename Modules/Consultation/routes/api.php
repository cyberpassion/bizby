<?php

use Illuminate\Support\Facades\Route;
use Modules\Consultation\Http\Controllers\ConsultationApiController;
use Modules\Consultation\Http\Controllers\ConsultationOptionController; // Options Controller

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('consultation', ConsultationController::class)->names('consultation');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('consultation', ConsultationApiController::class)->names('consultation');
	Route::get('/consultation/options/{key}', [ConsultationOptionController::class, 'get']); // Options Route
});