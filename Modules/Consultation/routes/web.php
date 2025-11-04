<?php

use Illuminate\Support\Facades\Route;
use Modules\Consultation\Http\Controllers\ConsultationController;

Route::middleware(['auth', 'verified'])->group(function () {
	// Custom Routes
	Route::get('consultation/home', [ConsultationController::class, 'home'])->name('consultation.home');
	Route::get('consultation/report', [ConsultationController::class, 'report'])->name('consultation.report');
	Route::get('consultation/settings', [ConsultationController::class, 'settings'])->name('consultation.settings');
	// Default Resource Routes
    Route::resource('consultation', ConsultationController::class)->names('consultation');
});