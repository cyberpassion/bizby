<?php

use Illuminate\Support\Facades\Route;
use Modules\Registration\Http\Controllers\RegistrationController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('registrations', RegistrationController::class)->names('registration');
	// Custom Routes
    Route::prefix('registration')->name('registration.')->group(function () {
        Route::get('home', [RegistrationController::class, 'home'])->name('home');
        Route::get('list', [RegistrationController::class, 'list'])->name('list');
        Route::get('report', [RegistrationController::class, 'report'])->name('report');
        Route::get('settings', [RegistrationController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [RegistrationController::class, 'view'])->name('view');
        Route::get('{id}/edit', [RegistrationController::class, 'edit'])->name('edit');
    });
});
