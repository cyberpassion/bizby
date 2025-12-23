<?php

namespace Modules\Booking\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Modules\Booking\Models\Booking;
use Modules\Booking\Services\BookingService;
use Modules\Booking\Services\BookingFeeService;

class BookingApiController extends Controller
{
    public function index($venueId)
    {
        $bookings = Booking::where('booking_venue_id', $venueId)
            ->latest()
            ->get();

        return response()->json([
            'status'  => 'success',
            'message' => 'Bookings fetched successfully',
            'data'    => $bookings,
        ]);
    }

    public function store( Request $request, BookingService $bookingService, BookingFeeService $feeService ) {
	    $data = $request->validate([
    	    'booking_venue_id' => 'required|exists:booking_venues,id',
        	'bookable_unit_id' => 'required|exists:bookable_units,id',
	        'booking_type'     => 'required|string',
    	    'start_at'         => 'required|date',
        	'end_at'           => 'nullable|date|after:start_at',
        	'meta'             => 'nullable|array',
	    ]);

	    $booking = $bookingService->createBooking($data);

	    $amount = $feeService->calculate($booking);

	    $booking->update([
    	    'amount' => $amount,
        	'status' => 'confirmed',
	    ]);

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Booking created successfully',
        	'data'    => [
            	'booking' => $booking,
            	'amount'  => $amount,
	        ],
    	], 201);
	}

    public function cancel(Booking $booking)
    {
        $booking->update([
            'status' => 'cancelled',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Booking cancelled successfully',
            'data'    => $booking,
        ]);
    }
}
