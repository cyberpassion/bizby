<?php

use Illuminate\Support\Facades\Route;
use Modules\Center\Http\Controllers\CenterController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('centers', CenterController::class)->names('center');
	// Custom Routes
    Route::prefix('center')->name('center.')->group(function () {
        Route::get('home', [CenterController::class, 'home'])->name('home');
        Route::get('list', [CenterController::class, 'list'])->name('list');
        Route::get('report', [CenterController::class, 'report'])->name('report');
        Route::get('settings', [CenterController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [CenterController::class, 'view'])->name('view');
        Route::get('{id}/edit', [CenterController::class, 'edit'])->name('edit');
    });
});
