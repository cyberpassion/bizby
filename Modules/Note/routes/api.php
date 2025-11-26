<?php

use Illuminate\Support\Facades\Route;
use Modules\Note\Http\Controllers\NoteController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('notes', NoteController::class)->names('note');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {
    Route::apiResource('notes', NoteApiController::class)->names('notes');
});
