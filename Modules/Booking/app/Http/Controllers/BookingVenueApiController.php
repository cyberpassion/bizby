<?php
namespace Modules\Booking\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Booking\Models\Venue;
use Illuminate\Http\Request;

class BookingVenueApiController extends Controller
{
    public function index()
    {
        return Venue::where('is_active', true)->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'meta' => 'array',
        ]);

        return Venue::create($data);
    }
}
