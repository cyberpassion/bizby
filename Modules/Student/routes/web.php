<?php

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\StudentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('students', StudentController::class)->names('student');
	// Custom Routes
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('home', [StudentController::class, 'home'])->name('home');
        Route::get('list', [StudentController::class, 'list'])->name('list');
        Route::get('report', [StudentController::class, 'report'])->name('report');
        Route::get('settings', [StudentController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [StudentController::class, 'view'])->name('view');
        Route::get('{id}/edit', [StudentController::class, 'edit'])->name('edit');
    });
});
