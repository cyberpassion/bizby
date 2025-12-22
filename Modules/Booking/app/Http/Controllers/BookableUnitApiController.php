<?php

namespace Modules\Booking\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Booking\Models\BookingVenue;
use Modules\Booking\Models\BookableUnit;

class BookableUnitApiController extends Controller
{
    /**
     * List units of a venue
     */
    public function index(BookingVenue $venue)
    {
        return response()->json([
            'status' => 'success',
            'data' => $venue->units()
                ->where('is_active', true)
                ->get(),
        ]);
    }

    /**
     * Store a new unit under a venue
     */
    public function store(Request $request, BookingVenue $venue)
    {
        $data = $request->all();

        // NEVER trust client for venue_id
        $data['booking_venue_id'] = $venue->id;

        $unit = BookableUnit::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Unit created successfully',
            'data' => $unit,
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
     * Update a unit
     */
    public function update(Request $request, BookingVenue $venue, BookableUnit $unit)
    {
        $this->assertUnitBelongsToVenue($venue, $unit);

        $data = $request->all();

        // Prevent venue hopping
        unset($data['booking_venue_id']);

        $unit->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Unit updated successfully',
            'data' => $unit,
        ]);
    }

    /**
     * Soft delete (disable) a unit
     */
    public function destroy(BookingVenue $venue, BookableUnit $unit)
    {
        $this->assertUnitBelongsToVenue($venue, $unit);

        $unit->update(['is_active' => false]);

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
