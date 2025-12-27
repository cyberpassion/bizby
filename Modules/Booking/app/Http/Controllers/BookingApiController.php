<?php

namespace Modules\Booking\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Modules\Booking\Models\Booking;
use Modules\Booking\Services\BookingService;
use Modules\Booking\Services\BookingFeeService;

use Carbon\Carbon;

class BookingApiController extends Controller
{

	public function index($venueId)
	{
	    $bookings = Booking::where('booking_venue_id', $venueId)
    	    ->latest()
        	->get()
        	->map(function ($booking) {
            	return [
                	// 🔹 Core fields
	                'id'                => $booking->id,
    	            'booking_venue_id'  => $booking->booking_venue_id,
        	        'bookable_unit_id'  => $booking->bookable_unit_id,
            	    'booking_type'      => $booking->booking_type,
                	'status'            => $booking->status,
                	'meta'              => $booking->meta,

	                // 🔹 Original datetime (source of truth)
    	            'start_at'          => $booking->start_at,
        	        'end_at'            => $booking->end_at,

	                // 🔹 Normalized fields (UI-ready)
    	            'start_date'        => Carbon::parse($booking->start_at)->toDateString(),
        	        'end_date'          => $booking->end_at
            	        ? Carbon::parse($booking->end_at)->toDateString()
                	    : null,

	                'start_time'        => Carbon::parse($booking->start_at)->format('H:i'),
    	            'end_time'          => $booking->end_at
        	            ? Carbon::parse($booking->end_at)->format('H:i')
            	        : null,

	                // 🔹 Audit
    	            'created_at'        => $booking->created_at,
        	        'updated_at'        => $booking->updated_at,
            	];
        	});

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Bookings fetched successfully',
        	'data'    => [
            	'data' => $bookings,
        	],
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
	    if ($booking->billed_at) {
    	    return response()->json([
        	    'status'  => 'failed',
            	'message' => 'Cannot cancel a billed booking',
	        ], 409);
    	}

	    $booking->update([
    	    'status' => 'cancelled',
	    ]);

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Booking cancelled successfully',
	    ]);
	}

	public function generateInvoice(
	    Booking $booking,
    	BookingFeeService $feeService
	) {
    	if ($booking->billed_at) {
        	return response()->json([
            	'status'  => 'failed',
	            'message' => 'Invoice already generated',
    	    ], 409);
    	}

	    if ($booking->status === 'cancelled') {
    	    return response()->json([
        	    'status'  => 'failed',
            	'message' => 'Cannot bill a cancelled booking',
	        ], 422);
    	}

	    $amount = $feeService->calculate($booking);
	    $tax    = round($amount * 0.18, 2); // GST example
    	$total  = $amount + $tax;

	    $booking->update([
			'invoice_number' => 'INV-' . now()->format('Ymd') . '-' . $booking->id,
	        'amount'       => $amount,
    	    'tax'          => $tax,
        	'total_amount' => $total,
	        'currency'     => 'INR',
    	    'billed_at'    => now(),
        	'status'       => 'confirmed',
	        'invoice_snapshot' => [
    	        'amount'    => $amount,
        	    'tax'       => $tax,
            	'total'     => $total,
	            'currency'  => 'INR',
    	        'issued_at' => now(),
        	],
	    ]);

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Invoice generated successfully',
        	'data'    => $booking->invoice_snapshot,
	    ]);
	}

	public function invoice(Booking $booking)
	{
    	if (!$booking->invoice_snapshot) {
	        return response()->json([
    	        'status'  => 'failed',
        	    'message' => 'Invoice not generated yet',
        	], 404);
    	}

	    return response()->json([
    	    'status' => 'success',
        	'data'   => $booking->invoice_snapshot,
    	]);
	}

}
