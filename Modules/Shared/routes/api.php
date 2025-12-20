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
use Modules\Shared\Http\Controllers\BarricadeApiController;
use Modules\Shared\Http\Controllers\SearchApiController;

use Modules\Shared\Http\Controllers\RazorpayWebhookController;

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
	Route::get('/options/group/{key}', [OptionApiController::class, 'group']);

	// Activity Logs
	Route::apiResource('activity-logs', ActivityLogApiController::class)->names('activityLog');

	// Online payment
	Route::post('/online-payments/initiate', [OnlinePaymentApiController::class, 'initiate']);
	Route::put('/online-payments/{id}/complete', [OnlinePaymentApiController::class, 'complete']);
	Route::apiResource('online-payments', OnlinePaymentApiController::class)->names('onlinePayment');

	// Payment Webhooks
	Route::post('webhooks/razorpay', [RazorpayWebhookController::class, 'handle']);

	Route::get('/barricade/{key}', [BarricadeApiController::class, 'get']);

	Route::get('/search/{module}', [SearchApiController::class, 'search']);
});