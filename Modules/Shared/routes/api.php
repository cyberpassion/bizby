<?php

use Illuminate\Support\Facades\Route;
use Modules\Shared\Http\Controllers\SharedApiController;
use Modules\Shared\Http\Controllers\LookupsController; // Options Controller
use Modules\Shared\Http\Controllers\UploadController; // Upload Controller
use Modules\Shared\Http\Controllers\SharedImportController;
use Modules\Shared\Http\Controllers\FormController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('shareds', SharedController::class)->names('shared');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('shared', SharedApiController::class)->names('shared');
	Route::get('/lookups/{key}', [LookupsController::class, 'get']); // Shared Resource Route
	Route::get('/form/{module}/{name}', [FormController::class, 'show']);
	
	// Uploads
	Route::get('/uploads', [UploadController::class, 'index']);
	Route::post('/uploads', [UploadController::class, 'store']);
	Route::delete('/uploads/{id}', [UploadController::class, 'destroy']);

});