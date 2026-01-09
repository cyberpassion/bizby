<?php

use Illuminate\Support\Facades\Route;
use Modules\Contact\Http\Controllers\ContactApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'contacts',
            ContactApiController::class
        )->names('contacts');
    });
