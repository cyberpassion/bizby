<?php

use Illuminate\Support\Facades\Route;
use Modules\Library\Http\Controllers\LibraryController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('libraries', LibraryController::class)->names('library');
	// Custom Routes
    Route::prefix('library')->name('library.')->group(function () {
        Route::get('home', [LibraryController::class, 'home'])->name('home');
        Route::get('list', [LibraryController::class, 'list'])->name('list');
        Route::get('report', [LibraryController::class, 'report'])->name('report');
        Route::get('settings', [LibraryController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [LibraryController::class, 'view'])->name('view');
        Route::get('{id}/edit', [LibraryController::class, 'edit'])->name('edit');
    });
});
