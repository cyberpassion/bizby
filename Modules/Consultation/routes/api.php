<?php

use Illuminate\Support\Facades\Route;
use Modules\Consultation\Http\Controllers\ConsultationApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('consultations', ConsultationController::class)->names('consultation');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
	// Always define static routes BEFORE apiResource
    Route::prefix('consultations')->name('consultations.')->group(function () {
        Route::get('stats', [ConsultationApiController::class, 'stats'])->name('stats');
    });
    Route::apiResource('consultations', ConsultationApiController::class)->names('consultations');
});