<?php

use Illuminate\Support\Facades\Route;
use Modules\Transport\Http\Controllers\TransportController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('transports', TransportController::class)->names('transport');
	// Custom Routes
    Route::prefix('transport')->name('transport.')->group(function () {
        Route::get('home', [TransportController::class, 'home'])->name('home');
        Route::get('list', [TransportController::class, 'list'])->name('list');
        Route::get('report', [TransportController::class, 'report'])->name('report');
        Route::get('settings', [TransportController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [TransportController::class, 'view'])->name('view');
        Route::get('{id}/edit', [TransportController::class, 'edit'])->name('edit');
    });
});
