<?php

use Illuminate\Support\Facades\Route;
use Modules\Visitplanner\Http\Controllers\VisitplannerController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('visitplanners', VisitplannerController::class)->names('visitplanner');
	// Custom Routes
    Route::prefix('visitplanner')->name('visitplanner.')->group(function () {
        Route::get('home', [VisitplannerController::class, 'home'])->name('home');
        Route::get('list', [VisitplannerController::class, 'list'])->name('list');
        Route::get('report', [VisitplannerController::class, 'report'])->name('report');
        Route::get('settings', [VisitplannerController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [VisitplannerController::class, 'view'])->name('view');
        Route::get('{id}/edit', [VisitplannerController::class, 'edit'])->name('edit');
    });
});
