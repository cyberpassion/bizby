<?php

use Illuminate\Support\Facades\Route;
use Modules\Employee\Http\Controllers\EmployeeController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('employees', EmployeeController::class)->names('employee');
	// Custom Routes
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('home', [EmployeeController::class, 'home'])->name('home');
        Route::get('list', [EmployeeController::class, 'list'])->name('list');
        Route::get('report', [EmployeeController::class, 'report'])->name('report');
        Route::get('settings', [EmployeeController::class, 'settings'])->name('settings');
        Route::get('{id}/view', [EmployeeController::class, 'view'])->name('view');
        Route::get('{id}/edit', [EmployeeController::class, 'edit'])->name('edit');
    });
});
