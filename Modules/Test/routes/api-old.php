<?php

use Illuminate\Support\Facades\Route;
use Modules\Test\Http\Controllers\TestController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('tests', TestController::class)->names('test');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('tests', TestApiController::class)->names('tests');
});
