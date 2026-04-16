<?php

use Illuminate\Support\Facades\Route;
use Modules\ConsumptionManagement\Http\Controllers\ConsumptionManagementController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('consumptionmanagements', ConsumptionManagementController::class)->names('consumptionmanagement');
});
