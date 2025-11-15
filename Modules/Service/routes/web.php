<?php

use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\ServiceController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('services', ServiceController::class)->names('service');
	// Custom Routes
    Route::prefix('service')->name('service.')->group(function () {
        Route::get('home', [ServiceController::class, 'home'])->name('home');
        Route::get('list', [ServiceController::class, 'list'])->name('list');
        Route::get('report', [ServiceController::class, 'report'])->name('report');
        Route::get('settings', [ServiceController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [ServiceController::class, 'view'])->name('view');
        Route::get('{id}/edit', [ServiceController::class, 'edit'])->name('edit');
    });
});
