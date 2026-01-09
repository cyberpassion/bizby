<?php

use Illuminate\Support\Facades\Route;
use Modules\Library\Http\Controllers\LibraryApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'librarys',
            LibraryApiController::class
        )->names('librarys');
    });
