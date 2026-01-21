<?php

use Illuminate\Support\Facades\Route;
use Modules\Registration\Http\Controllers\RegistrationApiController;
use Modules\Registration\Http\Controllers\RegistrationStepApiController;
use Modules\Registration\Http\Controllers\RegistrationDocumentApiController;
use Modules\Registration\Http\Controllers\RegistrationPaymentApiController;

Route::prefix('v1/registrations')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::post('/', [RegistrationApiController::class, 'create']);
        Route::get('/my', [RegistrationApiController::class, 'my']);
        Route::post('/{id}/submit', [RegistrationApiController::class, 'submit']);

        Route::post('/{id}/step', [RegistrationStepApiController::class, 'save']);
        Route::post('/{id}/document', [RegistrationDocumentApiController::class, 'upload']);
        Route::post('/{id}/pay', [RegistrationPaymentApiController::class, 'pay']);
    });
