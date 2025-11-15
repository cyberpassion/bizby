<?php

use Illuminate\Support\Facades\Route;
use Modules\Consultation\Http\Controllers\ConsultationController;

Route::middleware(['auth', 'verified'])->prefix('consultation')->name('consultation.')->group(function () {

    Route::get('/list', [ConsultationController::class, 'list'])->name('list'); // List page, we use this rather than usual page which has 's' as suffix
    Route::get('/report', [ConsultationController::class, 'report'])->name('report'); // Report page
    Route::get('/settings', [ConsultationController::class, 'settings'])->name('settings'); // Settings page

    // Custom actions
    Route::post('{id}/restore', [ConsultationController::class, 'restore'])->name('restore'); // Restore Page
    Route::get('{id}/document', [ConsultationController::class, 'document'])->name('document'); // List of documents like slips

	// Upload
	Route::get('{id}/upload', [ConsultationController::class, 'upload'])->name('upload'); // Upload Page
	Route::post('{id}/storeupload', [ConsultationController::class, 'storeUpload'])->name('storeUpload'); // Saving Uploads

    // Resourceful routes (index, create, store, show, edit, update, destroy)
    Route::resource('/', ConsultationController::class)
        ->parameters(['' => 'consultation'])
        ->names([
            'index' => 'index', // dashboard page
            'create' => 'create', // create entry
            'store' => 'store', // store created entry
            'show' => 'show', // 
            'edit' => 'edit', // edit entry
            'update' => 'update', // update edit
            'destroy' => 'destroy', // remove entry
        ]);
});
