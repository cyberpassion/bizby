<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\StudentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('students', StudentController::class)->names('student');
});

Route::prefix('student')->group(function () {
    // Index (list all students)
    Route::get('/', [StudentController::class, 'index'])->name('student.index');

    // Create
    Route::get('/create', [StudentController::class, 'create'])->name('student.create');   // Show create form
    Route::post('/', [StudentController::class, 'store'])->name('student.store');          // Store new student

    // Read
    Route::get('/list', [StudentController::class, 'list'])->name('student.list');         // Optional custom listing (if different from index)
    Route::get('/{id}', [StudentController::class, 'show'])->name('student.show');         // View a single student

    // Update
    Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');    // Show edit form
    Route::put('/{id}', [StudentController::class, 'update'])->name('student.update');     // Update student (use PUT/PATCH)

    // Delete
    Route::delete('/{id}', [StudentController::class, 'destroy'])->name('student.destroy'); // Delete student
});