<?php
namespace Modules\Booking\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Booking\Models\Booking;
use Modules\Booking\Services\BookingService;

class BookingApiController extends Controller
{
    public function index($venueId)
    {
        return Booking::where('booking_venue_id', $venueId)->latest()->get();
    }

    public function store(Request $request, BookingService $service)
    {
        $data = $request->validate([
            'booking_venue_id' => 'required|exists:venues,id',
            'bookable_unit_id' => 'required|exists:bookable_units,id',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after:start_at',
            'booking_type' => 'nullable|string',
            'meta' => 'array',
        ]);

        return $service->createBooking($data);
    }

    public function cancel(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);
        return response()->json(['status' => 'cancelled']);
    }
}
