<?php

use Illuminate\Support\Facades\Route;
use Modules\Visitplanner\Http\Controllers\VisitplannerController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('visitplanners', VisitplannerController::class)->names('visitplanner');
});
