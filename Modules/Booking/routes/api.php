<?php

use Illuminate\Support\Facades\Route;
use Modules\Booking\Http\Controllers\BookingVenueApiController;
use Modules\Booking\Http\Controllers\BookableUnitApiController;
use Modules\Booking\Http\Controllers\BookingApiController;
use Modules\Booking\Http\Controllers\BookingUnitPricingApiController;

Route::prefix('v1')->group(function () {
    Route::prefix('booking')->group(function () {

        // Units
		Route::post('/venues/{venue}/units', [BookableUnitApiController::class, 'store']); // SAME 1
        Route::post('/venues/units', [BookableUnitApiController::class, 'store']); // SAME 1 VARIATION 1 FOR FORMS
		Route::put('/venues/{venue}/units/{unit}', [BookableUnitApiController::class, 'update']); // SAME 2
		Route::put('/venues/units/{unit}', [BookableUnitApiController::class, 'update']); // SAME 2 VARIATION 1 FOR FORMS

        Route::get('/venues/{venue}/units', [BookableUnitApiController::class, 'index']); // SAME 4
		Route::get('/venues/units', [BookableUnitApiController::class, 'index1']); // SAME 4 VARIATION

        Route::get('/venues/{venue}/units/{unit}', [BookableUnitApiController::class, 'show']);
        Route::delete('/venues/{venue}/units/{unit}', [BookableUnitApiController::class, 'destroy']);

        // Unit pricing
		Route::post('/units/{unit}/pricing', [BookingUnitPricingApiController::class, 'store']); // SAME 3
		Route::post('/units/pricing', [BookingUnitPricingApiController::class, 'store']); // SAME 3 VARIATION 1 FOR FORMS
		Route::put('/units/{unit}/pricing/{pricing}', [BookingUnitPricingApiController::class, 'update']); // SAME 4
		Route::put('/units/pricing/{pricing}', [BookingUnitPricingApiController::class, 'update']); // SAME 4 VARIATION 1 FOR FORMS

        Route::get('/units/{unit}/pricing', [BookingUnitPricingApiController::class, 'index']);
		Route::get('/units/pricing', [BookingUnitPricingApiController::class, 'index']);

        Route::delete('/units/{unit}/pricing/{pricing}', [BookingUnitPricingApiController::class, 'destroy']);

        // Bookings
        Route::get('/venues/{venue}/bookings', [BookingApiController::class, 'index']);
        Route::post('/bookings', [BookingApiController::class, 'store']);
        Route::post('/bookings/preview-fee', [BookingApiController::class, 'previewFee']);
        Route::post('/bookings/{booking}/cancel', [BookingApiController::class, 'cancel']);

		// Invoice / Billing
		Route::post('/bookings/{booking}/generate-invoice',[BookingApiController::class, 'generateInvoice']);
		Route::get('/bookings/{booking}/invoice',[BookingApiController::class, 'invoice']);

        // Venues
        Route::apiResource('venues', BookingVenueApiController::class);
    });
});