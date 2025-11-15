<?php

use Illuminate\Support\Facades\Route;
use Modules\Signup\Http\Controllers\SignupController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('signups', SignupController::class)->names('signup');
	// Custom Routes
    Route::prefix('signup')->name('signup.')->group(function () {
        Route::get('home', [SignupController::class, 'home'])->name('home');
        Route::get('list', [SignupController::class, 'list'])->name('list');
        Route::get('report', [SignupController::class, 'report'])->name('report');
        Route::get('settings', [SignupController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [SignupController::class, 'view'])->name('view');
        Route::get('{id}/edit', [SignupController::class, 'edit'])->name('edit');
    });
});
