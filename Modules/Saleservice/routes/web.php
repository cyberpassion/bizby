<?php

use Illuminate\Support\Facades\Route;
use Modules\Saleservice\Http\Controllers\SaleserviceController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('saleservices', SaleserviceController::class)->names('saleservice');
	// Custom Routes
    Route::prefix('saleservice')->name('saleservice.')->group(function () {
        Route::get('home', [SaleserviceController::class, 'home'])->name('home');
        Route::get('list', [SaleserviceController::class, 'list'])->name('list');
        Route::get('report', [SaleserviceController::class, 'report'])->name('report');
        Route::get('settings', [SaleserviceController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [SaleserviceController::class, 'view'])->name('view');
        Route::get('{id}/edit', [SaleserviceController::class, 'edit'])->name('edit');
    });
});
