<?php

use Illuminate\Support\Facades\Route;
use Modules\Eventmanager\Http\Controllers\EventmanagerController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('eventmanagers', EventmanagerController::class)->names('eventmanager');
});
