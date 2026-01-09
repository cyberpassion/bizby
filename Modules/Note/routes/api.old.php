<?php

use Illuminate\Support\Facades\Route;
use Modules\Note\Http\Controllers\NoteApiController;
use Modules\Note\Http\Controllers\NoteThreadApiController;

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('notes', NoteController::class)->names('note');
});*/

// Temporarily disable auth middleware
Route::prefix('v1')->group(function () {

    Route::apiResource('note-threads', NoteThreadApiController::class)
        ->only(['index', 'store', 'show']);

    Route::post(
        'note-threads/{noteThread}/messages',
        [NoteApiController::class, 'store']
    );

    Route::patch(
        'notes/{note}/read',
        [NoteApiController::class, 'markRead']
    );
});