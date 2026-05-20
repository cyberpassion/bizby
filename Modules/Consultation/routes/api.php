<?php

use Illuminate\Support\Facades\Route;
use Modules\Consultation\Http\Controllers\ConsultationApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        // Always define static/custom routes BEFORE apiResource
        Route::prefix('consultations')->name('consultations.')->group(function () {

            Route::get('stats', [
                ConsultationApiController::class,
                'stats',
            ])->name('stats');

            Route::get('graphs', [
                ConsultationApiController::class,
                'graphs',
            ])->name('graphs');

            // Update consultation status
            Route::patch('{consultationId}/status', [
                ConsultationApiController::class,
                'updateStatus',
            ])->name('update-status');
        });

        Route::apiResource(
            'consultations',
            ConsultationApiController::class
        )->names('consultations');
    });
