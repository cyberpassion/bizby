<?php

use Illuminate\Support\Facades\Route;
use Modules\Timetable\Http\Controllers\TimetableController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('timetables', TimetableController::class)->names('timetable');
	// Custom Routes
    Route::prefix('timetable')->name('timetable.')->group(function () {
        Route::get('home', [TimetableController::class, 'home'])->name('home');
        Route::get('list', [TimetableController::class, 'list'])->name('list');
        Route::get('report', [TimetableController::class, 'report'])->name('report');
        Route::get('settings', [TimetableController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [TimetableController::class, 'view'])->name('view');
        Route::get('{id}/edit', [TimetableController::class, 'edit'])->name('edit');
    });
});
