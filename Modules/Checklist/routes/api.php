<?php

use Illuminate\Support\Facades\Route;
use Modules\Checklist\Http\Controllers\ChecklistApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::apiResource(
            'checklists',
            ChecklistApiController::class
        )->names('checklists');
    });
