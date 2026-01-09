<?php

use Illuminate\Support\Facades\Route;
use Modules\Booking\Http\Controllers\BookingVenueApiController;
use Modules\Booking\Http\Controllers\BookableUnitApiController;
use Modules\Booking\Http\Controllers\BookingApiController;
use Modules\Booking\Http\Controllers\BookingUnitPricingApiController;

Route::prefix('v1')
    ->middleware(['auth:sanctum', 'tenant'])
    ->group(function () {

        Route::prefix('booking')->group(function () {

            // Units
            Route::post('/venues/{venue}/units', [BookableUnitApiController::class, 'store']); 
            Route::post('/venues/units', [BookableUnitApiController::class, 'store']); 

            Route::put('/venues/{venue}/units/{unit}', [BookableUnitApiController::class, 'update']); 
            Route::put('/venues/units/{unit}', [BookableUnitApiController::class, 'update']); 

            Route::get('/venues/{venue}/units', [BookableUnitApiController::class, 'index']); 
            Route::get('/venues/units', [BookableUnitApiController::class, 'index1']); 

            Route::get('/venues/{venue}/units/{unit}', [BookableUnitApiController::class, 'show']);
            Route::delete('/venues/{venue}/units/{unit}', [BookableUnitApiController::class, 'destroy']);

            // Unit Pricing
            Route::post('/units/{unit}/pricing', [BookingUnitPricingApiController::class, 'store']); 
            Route::post('/units/pricing', [BookingUnitPricingApiController::class, 'store']); 

            Route::put('/units/{unit}/pricing/{pricing}', [BookingUnitPricingApiController::class, 'update']); 
            Route::put('/units/pricing/{pricing}', [BookingUnitPricingApiController::class, 'update']); 

            Route::get('/units/{unit}/pricing', [BookingUnitPricingApiController::class, 'index']);
            Route::get('/units/pricing', [BookingUnitPricingApiController::class, 'index']);

            Route::delete('/units/{unit}/pricing/{pricing}', [BookingUnitPricingApiController::class, 'destroy']);

            // Bookings
            Route::get('/venues/{venue}/bookings', [BookingApiController::class, 'index']);
            Route::post('/bookings', [BookingApiController::class, 'store']);
            Route::post('/bookings/preview-fee', [BookingApiController::class, 'previewFee']);
            Route::post('/bookings/{booking}/cancel', [BookingApiController::class, 'cancel']);

            // Invoice / Billing
            Route::post('/bookings/{booking}/generate-invoice', [BookingApiController::class, 'generateInvoice']);
            Route::get('/bookings/{booking}/invoice', [BookingApiController::class, 'invoice']);

            // Venues
            Route::apiResource('venues', BookingVenueApiController::class);
        });
    });
