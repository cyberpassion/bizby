<?php

use Illuminate\Support\Facades\Route;
use Modules\Consultation\Http\Controllers\ConsultationController;

Route::middleware(['auth', 'verified'])->group(function () {
	// Custom Routes
	Route::get('consultation/home', [ConsultationController::class, 'home'])->name('consultation.home');
	Route::get('consultations', [ConsultationController::class, 'list'])->name('consultation.list');
	Route::get('consultation/report', [ConsultationController::class, 'report'])->name('consultation.report');
	Route::get('consultation/settings', [ConsultationController::class, 'settings'])->name('consultation.settings');
	// Single Routes
	Route::get('/consultation/{id}/view', [ConsultationController::class, 'view'])->name('consultation.view'); // Consultation Resource Route
	Route::get('/consultation/{id}/edit', [ConsultationController::class, 'edit'])->name('consultation.edit'); // Consultation Resource Route
	// Default Resource Routes
    Route::resource('consultation', ConsultationController::class)->names('consultation');
});