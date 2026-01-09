<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'products',
            ProductApiController::class
        )->names('products');
    });
