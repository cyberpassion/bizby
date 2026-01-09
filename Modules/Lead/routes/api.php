<?php

use Illuminate\Support\Facades\Route;
use Modules\Lead\Http\Controllers\LeadApiController;
use Modules\Lead\Http\Controllers\LeadFollowupApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'leads.followups',
            LeadFollowupApiController::class
        )->shallow();

        Route::get(
            'leads/mandatory-fields',
            [LeadApiController::class, 'mandatoryFields']
        );

        Route::apiResource(
            'leads',
            LeadApiController::class
        );
    });
