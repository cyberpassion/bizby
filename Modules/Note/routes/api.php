<?php

use Illuminate\Support\Facades\Route;
use Modules\Note\Http\Controllers\NoteApiController;
use Modules\Note\Http\Controllers\NoteThreadApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        // Threads
        Route::apiResource('note-threads', NoteThreadApiController::class);

        Route::get('note-threads/internal', [NoteThreadApiController::class, 'internal']);
        Route::get('note-threads/external', [NoteThreadApiController::class, 'external']);

		Route::get('note-threads/assigned-to-me', [NoteThreadApiController::class, 'assignedToMe']);
        Route::get('note-threads/my-inbox', [NoteThreadApiController::class, 'myInbox']);

        // Messages
        Route::apiResource('notes', NoteApiController::class)->only(['store']);

        Route::get('note-threads/{id}/messages', [NoteApiController::class, 'byThread']);
    });