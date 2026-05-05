<?php

use Illuminate\Support\Facades\Route;

use Modules\Registration\Http\Controllers\RegistrationApiController;
use Modules\Registration\Http\Controllers\RegistrationStepApiController;
use Modules\Registration\Http\Controllers\RegistrationDocumentApiController;
use Modules\Registration\Http\Controllers\RegistrationPaymentApiController;

use Modules\Registration\Http\Controllers\RegistrationTypeApiController;
use Modules\Registration\Http\Controllers\RegistrationCycleApiController;
use Modules\Registration\Http\Controllers\RegistrationTypeStepApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {


		/*
        |--------------------------------------------------------------------------
        | PUBLIC FLOW APIs (MUST COME FIRST)
        |--------------------------------------------------------------------------
        */

        Route::get('registration-cycles/active', [RegistrationApiController::class, 'activeCycles']);
		Route::get('registration-cycles/available-for-me', [RegistrationApiController::class, 'availableForMe']);
        Route::get('registration-cycles/{id}/flow', [RegistrationApiController::class, 'flow']);

        /*
        |--------------------------------------------------------------------------
        | CONFIG APIs (Admin Side)
        |--------------------------------------------------------------------------
        | These define the system behavior (types, cycles, steps)
        | Used by admin panel to configure onboarding flows
        */

        // Registration Types (Admission, Vendor, etc.)
        Route::apiResource('registration-types', RegistrationTypeApiController::class);

        // Registration Cycles (Admission 2026-27, Vendor Intake Q1, etc.)
        Route::apiResource('registration-cycles', RegistrationCycleApiController::class);

        // Steps configuration per type (Basic Info, Documents, etc.)
        Route::apiResource('registration-type-steps', RegistrationTypeStepApiController::class);
		Route::post('registration-type-steps/bulk-save', [RegistrationTypeStepApiController::class, 'bulkSave']);


        /*
        |--------------------------------------------------------------------------
        | PUBLIC FLOW APIs (Used by frontend to render forms)
        |--------------------------------------------------------------------------
        */

        // Get all active cycles (shown on public portal)
        Route::get('registration-cycles/active', [RegistrationApiController::class, 'activeCycles'])
            ->name('registration-cycles.active');

        // Get full flow (steps + config) for a selected cycle
        Route::get('registration-cycles/{id}/flow', [RegistrationApiController::class, 'flow'])
            ->name('registration-cycles.flow');

        /*
        |--------------------------------------------------------------------------
        | REGISTRATION APIs (User Runtime Data)
        |--------------------------------------------------------------------------
        */

        // Stats & charts (admin dashboard)
        Route::prefix('registrations')->name('registrations.')->group(function () {
            Route::get('stats', [RegistrationApiController::class, 'stats'])->name('stats');
            Route::get('graphs', [RegistrationApiController::class, 'graphs'])->name('graphs');
        });

        // Get current user's registrations
        Route::get('registrations/my', [RegistrationApiController::class, 'my'])
            ->name('registrations.my');

		Route::post('registrations/my', [RegistrationApiController::class, 'createMyRegistration'])
            ->name('registrations.my');

		Route::get('registrations/my/{cycleId}', [RegistrationApiController::class, 'myCycle']);

        // Submit registration (final step)
        Route::post('registrations/{id}/submit', [RegistrationApiController::class, 'submit'])
            ->name('registrations.submit');

		// Standard CRUD (create, list, view, update, delete)
        Route::apiResource('registrations', RegistrationApiController::class)
            ->names('registrations');


        /*
        |--------------------------------------------------------------------------
        | STEP HANDLING (Dynamic multi-step form)
        |--------------------------------------------------------------------------
        */

		Route::post('registrations/save-step', [RegistrationStepApiController::class, 'saveInitial'])
		    ->name('registrations.save-initial-step');

        // Save step data
        Route::post('registrations/{id}/save-step', [RegistrationStepApiController::class, 'save'])
            ->name('registrations.step');

        /*
        |--------------------------------------------------------------------------
        | DOCUMENT UPLOAD
        |--------------------------------------------------------------------------
        */

        // Upload document for registration
        Route::post('registrations/{id}/document', [RegistrationDocumentApiController::class, 'upload'])
            ->name('registrations.document');

		// Upload document for registration
        Route::get('registrations/{id}/document', [RegistrationDocumentApiController::class, 'getUploads']);

        /*
        |--------------------------------------------------------------------------
        | PAYMENTS
        |--------------------------------------------------------------------------
        */

        // Make payment for registration
        Route::post('registrations/{id}/pay', [RegistrationPaymentApiController::class, 'pay'])
            ->name('registrations.pay');

    });


Route::prefix('v1')
    ->middleware(['tenant'])
    ->group(function () {


		/*
        |--------------------------------------------------------------------------
        | PUBLIC FLOW APIs (MUST COME FIRST)
        |--------------------------------------------------------------------------
        */

        Route::get('public/registration-cycles/active', [RegistrationApiController::class, 'activeCycles']);
		Route::get('public/registration-cycles/{id}', [RegistrationApiController::class, 'show']);
		Route::get('public/registration-cycles', [RegistrationApiController::class, 'index']);
	});