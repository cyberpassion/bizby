<?php

use Illuminate\Support\Facades\Route;
use Modules\Inventory\Http\Controllers\InventoryController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('inventories', InventoryController::class)->names('inventory');
	// Custom Routes
    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::get('home', [InventoryController::class, 'home'])->name('home');
        Route::get('list', [InventoryController::class, 'list'])->name('list');
        Route::get('report', [InventoryController::class, 'report'])->name('report');
        Route::get('settings', [InventoryController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [InventoryController::class, 'view'])->name('view');
        Route::get('{id}/edit', [InventoryController::class, 'edit'])->name('edit');
    });
});
