<?php

use Illuminate\Support\Facades\Route;
use Modules\Shared\Http\Controllers\SharedApiController;
use Modules\Shared\Http\Controllers\LookupsController; // Options Controller
use Modules\Shared\Http\Controllers\UploadController; // Upload Controller
use Modules\Shared\Http\Controllers\TermApiController;
use Modules\Shared\Http\Controllers\FormController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('shareds', SharedController::class)->names('shared');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('shared', SharedApiController::class)->names('shared');

	// Lookups for common static values like gender, list of countries
	Route::get('/lookups/{key}', [LookupsController::class, 'get']);
	Route::get('/form/{module}/{name}', [FormController::class, 'show']);

	// Terms for dynamic values like student classes etc
	Route::get('/terms', [TermApiController::class, 'index']);
	Route::post('/terms', [TermApiController::class, 'store']);
	Route::put('/terms/{id}', [TermApiController::class, 'update']);
	Route::delete('/terms/{id}', [TermApiController::class, 'destroy']);

	// Uploads
	Route::get('/uploads', [UploadController::class, 'index']);
	Route::post('/uploads', [UploadController::class, 'store']);
	Route::delete('/uploads/{id}', [UploadController::class, 'destroy']);

});