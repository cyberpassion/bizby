<?php

use Illuminate\Support\Facades\Route;
use Modules\Survey\Http\Controllers\SurveyController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('surveys', SurveyController::class)->names('survey');
	// Custom Routes
    Route::prefix('survey')->name('survey.')->group(function () {
        Route::get('home', [SurveyController::class, 'home'])->name('home');
        Route::get('list', [SurveyController::class, 'list'])->name('list');
        Route::get('report', [SurveyController::class, 'report'])->name('report');
        Route::get('settings', [SurveyController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [SurveyController::class, 'view'])->name('view');
        Route::get('{id}/edit', [SurveyController::class, 'edit'])->name('edit');
    });
});
