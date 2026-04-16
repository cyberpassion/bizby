<?php

use Illuminate\Support\Facades\Route;
use Modules\Incident\Http\Controllers\IncidentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('incidents', IncidentController::class)->names('incident');
	// Custom Routes
    Route::prefix('incident')->name('incident.')->group(function () {
        Route::get('home', [IncidentController::class, 'home'])->name('home');
        Route::get('list', [IncidentController::class, 'list'])->name('list');
        Route::get('report', [IncidentController::class, 'report'])->name('report');
        Route::get('settings', [IncidentController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [IncidentController::class, 'view'])->name('view');
        Route::get('{id}/edit', [IncidentController::class, 'edit'])->name('edit');
    });
});
