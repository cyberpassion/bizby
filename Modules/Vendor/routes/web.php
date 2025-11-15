<?php

use Illuminate\Support\Facades\Route;
use Modules\Vendor\Http\Controllers\VendorController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('vendors', VendorController::class)->names('vendor');
	// Custom Routes
    Route::prefix('vendor')->name('vendor.')->group(function () {
        Route::get('home', [VendorController::class, 'home'])->name('home');
        Route::get('list', [VendorController::class, 'list'])->name('list');
        Route::get('report', [VendorController::class, 'report'])->name('report');
        Route::get('settings', [VendorController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [VendorController::class, 'view'])->name('view');
        Route::get('{id}/edit', [VendorController::class, 'edit'])->name('edit');
    });
});
