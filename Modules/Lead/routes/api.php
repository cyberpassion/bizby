<?php

use Illuminate\Support\Facades\Route;
use Modules\Lead\Http\Controllers\LeadApiController;
use Modules\Lead\Http\Controllers\LeadFollowupApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('leads', LeadController::class)->names('lead');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {

    Route::apiResource('leads', LeadApiController::class);

    Route::apiResource(
        'leads.followups',
        LeadFollowupApiController::class
    )->shallow();

});
