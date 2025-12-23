<?php

namespace Modules\Booking\Services;

use Carbon\Carbon;
use Modules\Booking\Models\Booking;
use Illuminate\Validation\ValidationException;

class BookingFeeService
{
    public function calculate(Booking $booking): float
    {
        $pricing = $booking->unit
            ->pricings()
            ->where('booking_type', $booking->booking_type)
            ->first();

        if (!$pricing) {
            throw ValidationException::withMessages([
                'pricing' => ['Pricing not configured for this unit.'],
            ]);
        }

        $start = Carbon::parse($booking->start_at);
        $end   = Carbon::parse($booking->end_at ?? now());

        return match ($pricing->charge_type) {

            'per_night' =>
                max(1, $start->diffInDays($end)) * $pricing->price,

            'per_day' =>
                max(1, $start->diffInDays($end)) * $pricing->price,

            'per_hour' =>
                ceil($start->diffInMinutes($end) / 60) * $pricing->price,

            'per_slot' =>
                $pricing->price,

            default =>
                throw ValidationException::withMessages([
                    'pricing' => ['Invalid charge type.'],
                ]),
        };
    }
}
