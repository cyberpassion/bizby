<?php

use Illuminate\Support\Facades\Route;
use Modules\Asset\Http\Controllers\AssetController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('assets', AssetController::class)->names('asset');
	// Custom Routes
    Route::prefix('asset')->name('asset.')->group(function () {
        Route::get('home', [AssetController::class, 'home'])->name('home');
        Route::get('list', [AssetController::class, 'list'])->name('list');
        Route::get('report', [AssetController::class, 'report'])->name('report');
        Route::get('settings', [AssetController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [AssetController::class, 'view'])->name('view');
        Route::get('{id}/edit', [AssetController::class, 'edit'])->name('edit');
    });
});
