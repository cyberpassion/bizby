<?php

use Illuminate\Support\Facades\Route;
use Modules\Shared\Http\Controllers\SharedUploadController;
use Modules\Shared\Http\Controllers\SharedImportController;

Route::middleware(['auth', 'verified'])->prefix('upload')->name('upload.')->group(function () {

    // ----------------------
    // MEDIA UPLOAD (images/files)
    // ----------------------
    Route::get('/file/{id}', [SharedUploadController::class, 'show'])->name('file.show');
    Route::post('/file', [SharedUploadController::class, 'store'])->name('file.store');
    Route::delete('/file/{id}', [SharedUploadController::class, 'delete'])->name('file.delete');


    // ----------------------
    // EXCEL DATA IMPORT
    // ----------------------
    Route::get('/import/{module}', [SharedImportController::class, 'show'])->name('import.show');
    Route::post('/import/{module}', [SharedImportController::class, 'import'])->name('import.process');
});
