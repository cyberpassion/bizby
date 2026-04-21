<?php

use Illuminate\Support\Facades\Route;
use Modules\Inventory\Http\Controllers\InventoryApiController;
use Modules\Inventory\Http\Controllers\InventoryTransactionApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

		Route::prefix('inventories')->name('inventories.')->group(function () {
            Route::get('stats', [InventoryApiController::class, 'stats'])->name('stats');
            Route::get('graphs', [InventoryApiController::class, 'graphs'])->name('graphs');
        });

        // Inventory CRUD
        Route::apiResource(
            'inventories',
            InventoryApiController::class
        )->names('inventories');

		/*
        |--------------------------------------------------------------------------
        | Global Transactions (NEW)
        |--------------------------------------------------------------------------
        */
        Route::post('inventories/transactions', [InventoryTransactionApiController::class, 'store']);

        /*
        |--------------------------------------------------------------------------
        | Inventory Transactions
        |--------------------------------------------------------------------------
        */

        Route::prefix('inventories/{id}')->group(function () {

            // Superset endpoint (recommended)
            Route::post('transaction', [InventoryTransactionApiController::class, 'transaction']);

            // Specific endpoints
            Route::post('in',       [InventoryTransactionApiController::class, 'stockIn']);
            Route::post('out',      [InventoryTransactionApiController::class, 'stockOut']);
            Route::post('adjust',   [InventoryTransactionApiController::class, 'adjust']);
            Route::post('transfer', [InventoryTransactionApiController::class, 'transfer']);

            // Transaction history
            Route::get('transactions', [InventoryTransactionApiController::class, 'index']);
        });

    });