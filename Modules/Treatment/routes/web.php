<?php

use Illuminate\Support\Facades\Route;
use Modules\Treatment\Http\Controllers\TreatmentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('treatments', TreatmentController::class)->names('treatment');
	// Custom Routes
    Route::prefix('treatment')->name('treatment.')->group(function () {
        Route::get('home', [TreatmentController::class, 'home'])->name('home');
        Route::get('list', [TreatmentController::class, 'list'])->name('list');
        Route::get('report', [TreatmentController::class, 'report'])->name('report');
        Route::get('settings', [TreatmentController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [TreatmentController::class, 'view'])->name('view');
        Route::get('{id}/edit', [TreatmentController::class, 'edit'])->name('edit');
    });
});
