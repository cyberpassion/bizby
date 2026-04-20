<?php

use Illuminate\Support\Facades\Route;
use Modules\Lead\Http\Controllers\LeadApiController;
use Modules\Lead\Http\Controllers\LeadFollowupApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::prefix('leads')->name('leads.')->group(function () {

            /* ======================================================
             | DASHBOARD
             ====================================================== */
            Route::get('stats', [LeadApiController::class, 'stats'])->name('stats');
            Route::get('graphs', [LeadApiController::class, 'graphs'])->name('graphs');

            /* ======================================================
             | CONFIG / HELPERS
             ====================================================== */
            Route::get('mandatory-fields', [LeadApiController::class, 'mandatoryFields'])
                ->name('mandatory-fields');

            /* ======================================================
             | FOLLOWUPS (NESTED)
             ====================================================== */
            Route::apiResource(
                '{lead}/followups',
                LeadFollowupApiController::class
            )->shallow()->names('followups');
        });

        /* ======================================================
         | LEADS CRUD (KEEP SEPARATE)
         ====================================================== */
        Route::apiResource(
            'leads',
            LeadApiController::class
        )->names('leads');
    });