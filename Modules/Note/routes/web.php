<?php

use Illuminate\Support\Facades\Route;
use Modules\Note\Http\Controllers\NoteController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('notes', NoteController::class)->names('note');
	// Custom Routes
    Route::prefix('note')->name('note.')->group(function () {
        Route::get('home', [NoteController::class, 'home'])->name('home');
        Route::get('list', [NoteController::class, 'list'])->name('list');
        Route::get('report', [NoteController::class, 'report'])->name('report');
        Route::get('settings', [NoteController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [NoteController::class, 'view'])->name('view');
        Route::get('{id}/edit', [NoteController::class, 'edit'])->name('edit');
    });
});
