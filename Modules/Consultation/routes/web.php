<?php

use Illuminate\Support\Facades\Route;
use Modules\Consultation\Http\Controllers\ConsultationController;

Route::middleware(['auth', 'verified'])->group(function () {
	// Custom Routes
	Route::get('consultation/home', [ConsultationController::class, 'home'])->name('consultation.home');
	Route::get('consultation/react', [ConsultationController::class, 'react'])->name('consultation.react');
	// Default Resource Routes
    Route::resource('consultation', ConsultationController::class)->names('consultation');
});