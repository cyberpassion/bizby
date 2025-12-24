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
	 * List pricing (nested + flat)
	 */
	public function index(Request $request, ?BookableUnit $unit = null)
	{
    	$query = BookingUnitPricing::query();

	    // Route-model binding has priority
    	if ($unit) {
        	$query->where('bookable_unit_id', $unit->id);
	    }
    	// Fallback to query param
    	elseif ($request->filled('bookable_unit_id')) {
        	$query->where('bookable_unit_id', $request->query('bookable_unit_id'));
    	}

	    $pricings = $query->get();

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Pricing fetched successfully',
        	'data'    => [
            	'data' => $pricings
        	],
    	]);
	}

    /**
	 * Store pricing (nested + flat)
	 */
	public function store(Request $request, ?BookableUnit $unit = null)
	{
    	$data = $request->validate([
        	'bookable_unit_id' => 'required_without:unit|exists:bookable_units,id',
        	'booking_type'     => 'required|string',
        	'charge_type'      => 'required|in:per_night,per_day,per_hour,per_slot',
        	'price'            => 'required|numeric|min:0',
	    ]);

	    // 🔐 Never trust client if unit comes from URL
    	$unitId = $unit?->id ?? $data['bookable_unit_id'];

	    // Prevent duplicate pricing per booking_type
    	if (
        	BookingUnitPricing::where('bookable_unit_id', $unitId)
            	->where('booking_type', $data['booking_type'])
            	->exists()
	    ) {
    	    throw ValidationException::withMessages([
        	    'booking_type' => ['Pricing already exists for this booking type.'],
        	]);
	    }

	    $pricing = BookingUnitPricing::create([
    	    'bookable_unit_id' => $unitId,
        	'booking_type'     => $data['booking_type'],
        	'charge_type'      => $data['charge_type'],
        	'price'            => $data['price'],
	    ]);

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Pricing created successfully',
        	'data'    => $pricing,
	    ], 201);
	}

    /**
	 * Update pricing (nested + flat)
	 */
	public function update(
	    Request $request,
    	?BookableUnit $unit = null,
    	BookingUnitPricing $pricing
	) {
    	// 🔐 If unit is provided in URL, assert ownership
    	if ($unit && $pricing->bookable_unit_id !== $unit->id) {
        	abort(404);
    	}

	    $data = $request->validate([
    	    'charge_type' => 'sometimes|in:per_night,per_day,per_hour,per_slot',
        	'price'       => 'sometimes|numeric|min:0',
	    ]);

	    // 🔒 Prevent unit hopping always
    	unset($data['bookable_unit_id']);

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
