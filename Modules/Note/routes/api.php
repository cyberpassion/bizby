<?php

use Illuminate\Support\Facades\Route;
use Modules\Note\Http\Controllers\NoteApiController;
use Modules\Note\Http\Controllers\NoteThreadApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

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
