<?php

use Illuminate\Support\Facades\Route;
use Modules\Consultation\Http\Controllers\ConsultationController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('consultations', ConsultationController::class)->names('consultation');

	// Create
    Route::get('/create', [ConsultationController::class, 'create'])->name('consultation.create');   // Show create form
    Route::post('/', [ConsultationController::class, 'store'])->name('consultation.store');          // Store new consultation

    // Read
    Route::get('/list', [ConsultationController::class, 'list'])->name('consultation.list');         // Optional custom listing (if different from index)
    Route::get('/{id}', [ConsultationController::class, 'show'])->name('consultation.show');         // View a single consultation

    // Update
    Route::get('/{id}/edit', [ConsultationController::class, 'edit'])->name('consultation.edit');    // Show edit form
    Route::put('/{id}', [ConsultationController::class, 'update'])->name('consultation.update');     // Update consultation (use PUT/PATCH)

    // Delete
    Route::delete('/{id}', [ConsultationController::class, 'destroy'])->name('consultation.destroy'); // Delete consultation
});
