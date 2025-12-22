<?php
namespace Modules\Booking\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Booking\Models\Venue;
use Illuminate\Http\Request;

class BookingUnitApiController extends Controller
{
    public function index(Venue $venue)
    {
        return $venue->units()->where('is_active', true)->get();
    }

    public function store(Request $request, Venue $venue)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'unit_type' => 'required|string',
            'capacity' => 'nullable|integer',
            'meta' => 'array',
        ]);

        return $venue->units()->create($data);
    }
}
