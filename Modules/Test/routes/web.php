<?php

use Illuminate\Support\Facades\Route;
use Modules\Test\Http\Controllers\TestController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tests', TestController::class)->names('test');
	// Custom Routes
    Route::prefix('test')->name('test.')->group(function () {
        Route::get('home', [TestController::class, 'home'])->name('home');
        Route::get('list', [TestController::class, 'list'])->name('list');
        Route::get('report', [TestController::class, 'report'])->name('report');
        Route::get('settings', [TestController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [TestController::class, 'view'])->name('view');
        Route::get('{id}/edit', [TestController::class, 'edit'])->name('edit');
    });
});
