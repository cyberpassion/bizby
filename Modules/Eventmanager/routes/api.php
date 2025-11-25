<?php

use Illuminate\Support\Facades\Route;
use Modules\Eventmanager\Http\Controllers\EventmanagerController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('eventmanagers', EventmanagerController::class)->names('eventmanager');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('eventmanagers', EventmanagerApiController::class)->names('eventmanagers');
});
