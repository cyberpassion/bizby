<?php

use Illuminate\Support\Facades\Route;
use Modules\Lead\Http\Controllers\LeadController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('leads', LeadController::class)->names('lead');
	// Custom Routes
    Route::prefix('lead')->name('lead.')->group(function () {
        Route::get('home', [LeadController::class, 'home'])->name('home');
        Route::get('list', [LeadController::class, 'list'])->name('list');
        Route::get('report', [LeadController::class, 'report'])->name('report');
        Route::get('settings', [LeadController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [LeadController::class, 'view'])->name('view');
        Route::get('{id}/edit', [LeadController::class, 'edit'])->name('edit');
    });
});
