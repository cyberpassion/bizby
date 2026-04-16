<?php

use Illuminate\Support\Facades\Route;
use Modules\Registration\Http\Controllers\RegistrationApiController;
use Modules\Registration\Http\Controllers\RegistrationStepApiController;
use Modules\Registration\Http\Controllers\RegistrationDocumentApiController;
use Modules\Registration\Http\Controllers\RegistrationPaymentApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::prefix('registrations')->name('registrations.')->group(function () {
            Route::get('stats', [RegistrationApiController::class, 'stats'])->name('stats');
            Route::get('graphs', [RegistrationApiController::class, 'graphs'])->name('graphs');
        });

        // Standard CRUD
        Route::apiResource(
            'registrations',
            RegistrationApiController::class
        )->names('registrations');

        // Custom Actions
        Route::get('registrations/my', [RegistrationApiController::class, 'my'])->name('registrations.my');
        Route::post('registrations/{id}/submit', [RegistrationApiController::class, 'submit'])->name('registrations.submit');

        // Step handling
        Route::post('registrations/{id}/step', [RegistrationStepApiController::class, 'save'])->name('registrations.step');

        // Document upload
        Route::post('registrations/{id}/document', [RegistrationDocumentApiController::class, 'upload'])->name('registrations.document');

        // Payment
        Route::post('registrations/{id}/pay', [RegistrationPaymentApiController::class, 'pay'])->name('registrations.pay');

    });