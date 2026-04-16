<?php

use Illuminate\Support\Facades\Route;
use Modules\Incident\Http\Controllers\IncidentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('incidents', IncidentController::class)->names('incident');
});
