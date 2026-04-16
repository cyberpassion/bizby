<?php

use Illuminate\Support\Facades\Route;
use Modules\Inventory\Http\Controllers\InventoryApiController;
use Modules\Inventory\Http\Controllers\InventoryTransactionApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::prefix('inventory')->name('inventory.')->group(function () {

            // Dashboard
            Route::get('stats', [InventoryApiController::class, 'stats'])->name('stats');
            Route::get('graphs', [InventoryApiController::class, 'graphs'])->name('graphs');

            // Alerts
            Route::get('alerts/low-stock', [InventoryApiController::class, 'lowStock'])->name('low-stock');

            // Transactions (CORE)
            Route::post('{item}/in', [InventoryTransactionApiController::class, 'stockIn'])->name('in');
            Route::post('{item}/out', [InventoryTransactionApiController::class, 'stockOut'])->name('out');
            Route::post('{item}/adjust', [InventoryTransactionApiController::class, 'adjust'])->name('adjust');

            // Transfer (future-ready)
            Route::post('{item}/transfer', [InventoryTransactionApiController::class, 'transfer'])->name('transfer');

            // History
            Route::get('{item}/transactions', [InventoryTransactionApiController::class, 'index'])->name('transactions');
        });

        Route::apiResource(
            'inventory',
            InventoryApiController::class
        )->names('inventory');
    });