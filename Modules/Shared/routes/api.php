<?php

use Illuminate\Support\Facades\Route;
use Modules\Shared\Http\Controllers\SharedApiController;
use Modules\Shared\Http\Controllers\LookupsApiController; // Options Controller
use Modules\Shared\Http\Controllers\UploadApiController; // Upload Controller
use Modules\Shared\Http\Controllers\TermApiController;
use Modules\Shared\Http\Controllers\OnlinePaymentApiController;
use Modules\Shared\Http\Controllers\OptionApiController;
use Modules\Shared\Http\Controllers\ActivityLogApiController;
use Modules\Shared\Http\Controllers\FormApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('shareds', SharedController::class)->names('shared');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('shared', SharedApiController::class)->names('shared');

	// Lookups for common static values like gender, list of countries
	Route::get('/lookups/{key}', [LookupsApiController::class, 'get']);
	Route::get('/form/{module}/{name}', [FormApiController::class, 'show']);

	// Terms for dynamic values like student classes etc
	Route::apiResource('terms', TermApiController::class)->names('term');

	// Uploads
	Route::apiResource('uploads', UploadApiController::class)->names('upload');

	// Options
	Route::apiResource('options', OptionApiController::class)->names('option');

	// Activity Logs
	Route::apiResource('activity-logs', ActivityLogApiController::class)->names('activityLog');

	// Online payment
	Route::apiResource('online-payments', OnlinePaymentApiController::class)->names('onlinePayment');
});