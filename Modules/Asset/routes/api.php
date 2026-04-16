<?php

use Illuminate\Support\Facades\Route;
use Modules\Asset\Http\Controllers\AssetApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::prefix('assets')->name('assets.')->group(function () {
            Route::get('stats', [AssetApiController::class, 'stats'])->name('stats');
            Route::get('graphs', [AssetApiController::class, 'graphs'])->name('graphs');

            // Extra useful endpoints
            Route::get('{asset}/history', [AssetApiController::class, 'history'])->name('history');
            Route::post('{asset}/assign', [AssetApiController::class, 'assign'])->name('assign');
            Route::post('{asset}/transfer', [AssetApiController::class, 'transfer'])->name('transfer');
            Route::post('{asset}/maintenance', [AssetApiController::class, 'maintenance'])->name('maintenance');
            Route::post('{asset}/status', [AssetApiController::class, 'updateStatus'])->name('status');
        });

        Route::apiResource(
            'assets',
            AssetApiController::class
        )->names('assets');
    });