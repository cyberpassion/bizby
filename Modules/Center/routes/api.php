<?php

use Illuminate\Support\Facades\Route;
use Modules\Center\Http\Controllers\CenterApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::prefix('centers')->name('centers.')->group(function () {
            Route::get('stats', [CenterApiController::class, 'stats'])->name('stats');
            Route::get('graphs', [CenterApiController::class, 'graphs'])->name('graphs');
        });

        Route::apiResource(
            'centers',
            CenterApiController::class
        )->names('centers');
    });