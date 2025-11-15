<?php

use Illuminate\Support\Facades\Route;
use Modules\Patient\Http\Controllers\PatientController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('patients', PatientController::class)->names('patient');
	// Custom Routes
    Route::prefix('patient')->name('patient.')->group(function () {
        Route::get('home', [PatientController::class, 'home'])->name('home');
        Route::get('list', [PatientController::class, 'list'])->name('list');
        Route::get('report', [PatientController::class, 'report'])->name('report');
        Route::get('settings', [PatientController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [PatientController::class, 'view'])->name('view');
        Route::get('{id}/edit', [PatientController::class, 'edit'])->name('edit');
    });
});
