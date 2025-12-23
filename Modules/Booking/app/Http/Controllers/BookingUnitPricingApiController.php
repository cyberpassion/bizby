<?php

namespace Modules\Booking\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Modules\Booking\Models\BookableUnit;
use Modules\Booking\Models\BookingUnitPricing;

class BookingUnitPricingApiController extends Controller
{
    /**
     * List pricing for a unit
     */
    public function index(BookableUnit $unit)
    {
        return response()->json([
            'status'  => 'success',
            'message' => 'Pricing fetched successfully',
            'data'    => $unit->pricings,
        ]);
    }

    /**
     * Store pricing for a unit
     */
    public function store(Request $request, BookableUnit $unit)
    {
        $data = $request->validate([
            'booking_type' => 'required|string',
            'charge_type'  => 'required|in:per_night,per_day,per_hour,per_slot',
            'price'        => 'required|numeric|min:0',
        ]);

        // Prevent duplicate pricing per booking_type
        if ($unit->pricings()->where('booking_type', $data['booking_type'])->exists()) {
            throw ValidationException::withMessages([
                'booking_type' => ['Pricing already exists for this booking type.'],
            ]);
        }

        $pricing = $unit->pricings()->create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Pricing created successfully',
            'data'    => $pricing,
        ], 201);
    }

    /**
     * Update pricing
     */
    public function update(
        Request $request,
        BookableUnit $unit,
        BookingUnitPricing $pricing
    ) {
        // Safety: ensure pricing belongs to unit
        if ($pricing->bookable_unit_id !== $unit->id) {
            abort(404);
        }

        $data = $request->validate([
            'charge_type' => 'sometimes|in:per_night,per_day,per_hour,per_slot',
            'price'       => 'sometimes|numeric|min:0',
        ]);

        $pricing->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Pricing updated successfully',
            'data'    => $pricing,
        ]);
    }

    /**
     * Delete pricing
     */
    public function destroy(
        BookableUnit $unit,
        BookingUnitPricing $pricing
    ) {
        if ($pricing->bookable_unit_id !== $unit->id) {
            abort(404);
        }

        $pricing->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Pricing deleted successfully',
        ]);
    }
}
