<?php

use Illuminate\Support\Facades\Route;
use Modules\Lead\Http\Controllers\LeadApiController;
use Modules\Lead\Http\Controllers\LeadFollowupApiController;
use Modules\Lead\Http\Controllers\LeadReportApiController;

Route::prefix('v1')
    ->middleware([
        'auth:sanctum',
        'tenant'
    ])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | REPORTS
        |--------------------------------------------------------------------------
        */

        Route::prefix('leads/reports')
            ->group(function () {

                Route::get(
                    '/',
                    [
                        LeadReportApiController::class,
                        'index'
                    ]
                );
            });

        /*
        |--------------------------------------------------------------------------
        | LEADS
        |--------------------------------------------------------------------------
        */

        Route::prefix('leads')
            ->name('leads.')
            ->group(function () {

                Route::get(
                    'stats',
                    [
                        LeadApiController::class,
                        'stats'
                    ]
                )->name('stats');

                Route::get(
                    'graphs',
                    [
                        LeadApiController::class,
                        'graphs'
                    ]
                )->name('graphs');

                Route::get(
                    'mandatory-fields',
                    [
                        LeadApiController::class,
                        'mandatoryFields'
                    ]
                )->name('mandatory-fields');

                Route::apiResource(
                    '{id}/followups',
                    LeadFollowupApiController::class
                )->shallow()->names('followups');
            });

        /*
        |--------------------------------------------------------------------------
        | CRUD
        |--------------------------------------------------------------------------
        */

        Route::apiResource(
            'leads',
            LeadApiController::class
        )->names('leads');
    });