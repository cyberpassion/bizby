<?php

use Illuminate\Support\Facades\Route;
use Modules\Shared\Http\Controllers\UploadController;
use Modules\Shared\Http\Controllers\SharedImportController;

Route::middleware(['auth', 'verified'])->group(function () {

    // ----------------------
    // MEDIA UPLOAD
    // ----------------------
    Route::get('/uploads/{referenceId}/{fileKey}', [UploadController::class, 'show'])->name('upload.show');
    Route::post('/uploads', [UploadController::class, 'store'])->name('upload.store');
    Route::delete('/uploads/{referenceId}/{fileKey}', [UploadController::class, 'delete'])->name('upload.delete');

    // ----------------------
    // EXCEL DATA IMPORT
    // ----------------------
    Route::get('/import/{module}', [SharedImportController::class, 'show'])->name('import.show');
    Route::post('/import/{module}', [SharedImportController::class, 'import'])->name('import.process');

});