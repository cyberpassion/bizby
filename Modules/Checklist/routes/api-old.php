<?php

use Illuminate\Support\Facades\Route;
use Modules\Checklist\Http\Controllers\ChecklistController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('checklists', ChecklistController::class)->names('checklist');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('checklists', ChecklistApiController::class)->names('checklists');
});
