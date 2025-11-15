<?php

use Illuminate\Support\Facades\Route;
use Modules\Visitactivity\Http\Controllers\VisitactivityController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('visitactivities', VisitactivityController::class)->names('visitactivity');
	// Custom Routes
    Route::prefix('visitactivity')->name('visitactivity.')->group(function () {
        Route::get('home', [VisitactivityController::class, 'home'])->name('home');
        Route::get('list', [VisitactivityController::class, 'list'])->name('list');
        Route::get('report', [VisitactivityController::class, 'report'])->name('report');
        Route::get('settings', [VisitactivityController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [VisitactivityController::class, 'view'])->name('view');
        Route::get('{id}/edit', [VisitactivityController::class, 'edit'])->name('edit');
    });
});
