<?php

namespace Modules\Booking\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Booking\Models\BookingVenue;
use Modules\Booking\Models\BookableUnit;

class BookableUnitApiController extends Controller
{
    /**
	 * List units (nested + flat)
	 */
	public function index(Request $request, ?BookingVenue $venue = null)
	{
	    // Resolve venue if available
    	$venueId = $venue?->id ?? $request->query('booking_venue_id');

	    $query = BookableUnit::query();

	    // Apply venue filter only when present
    	if ($venueId) {
        	$query->where('booking_venue_id', $venueId);
    	}

	    $units = $query->get();

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Units fetched successfully',
        	'data'    => ['data'=>$units],
	    ]);
	}

    /**
	 * Store a new unit (supports both nested & flat routes)
	 */
	public function store(Request $request, ?BookingVenue $venue = null)
	{
    	$data = $request->validate([
	        'booking_venue_id' => 'required_without:venue|exists:booking_venues,id',
    	    'name'             => 'required|string|max:255',
        	'unit_type'        => 'required|string',
        	'capacity'         => 'nullable|integer|min:1',
	    ]);

	    // 🔐 NEVER trust client if venue is in URL
    	$data['booking_venue_id'] = $venue?->id ?? $data['booking_venue_id'];

	    $unit = BookableUnit::create($data);

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Unit created successfully',
        	'data'    => $unit,
	    ], 201);
	}

    /**
     * Show a single unit (scoped to venue)
     */
    public function show(BookingVenue $venue, BookableUnit $unit)
    {
        $this->assertUnitBelongsToVenue($venue, $unit);

        return response()->json([
            'status' => 'success',
            'data' => $unit,
        ]);
    }

    /**
	 * Update a unit (supports nested & flat routes)
	 */
	public function update(
    	Request $request,
    	?BookingVenue $venue = null,
    	BookableUnit $unit
	) {
	    // 🔐 If venue is provided in URL, assert ownership
    	if ($venue) {
        	$this->assertUnitBelongsToVenue($venue, $unit);
    	}

	    $data = $request->validate([
    	    'name'      => 'sometimes|required|string|max:255',
        	'unit_type' => 'sometimes|required|string',
        	'capacity'  => 'nullable|integer|min:1',
	    ]);

	    // 🔒 Prevent venue hopping (always)
    	unset($data['booking_venue_id']);

	    $unit->update($data);

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Unit updated successfully',
        	'data'    => $unit,
	    ]);
	}

    /**
     * Soft delete (disable) a unit
     */
    public function destroy(BookingVenue $venue, BookableUnit $unit)
    {
        $this->assertUnitBelongsToVenue($venue, $unit);

        $unit->update(['status' => false]);

        return response()->json([
            'status' => 'success',
            'message' => 'Unit deleted successfully',
        ]);
    }

    /**
     * Ensure unit belongs to venue
     */
    protected function assertUnitBelongsToVenue(BookingVenue $venue, BookableUnit $unit): void
    {
        // ❗ FIXED: correct foreign key
        if ($unit->booking_venue_id !== $venue->id) {
            abort(404, 'Unit not found for this venue');
        }
    }
}
