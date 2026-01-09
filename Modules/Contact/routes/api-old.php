<?php

use Illuminate\Support\Facades\Route;
use Modules\Contact\Http\Controllers\ContactApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('contacts', ContactController::class)->names('contact');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('contacts', ContactApiController::class)->names('contacts');
});
