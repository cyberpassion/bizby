<?php
namespace Modules\Booking\Services;

use Modules\Booking\Models\Booking;
use Illuminate\Validation\ValidationException;

class BookingService
{
    public function createBooking(array $data): Booking
    {
        $exists = Booking::where('bookable_unit_id', $data['bookable_unit_id'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->where(function ($q) use ($data) {
                $q->where('start_at', '<', $data['end_at'] ?? now())
                  ->where(function ($q2) use ($data) {
                      $q2->whereNull('end_at')
                         ->orWhere('end_at', '>', $data['start_at']);
                  });
            })
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'booking' => 'This unit is already booked for the selected time.'
            ]);
        }

        return Booking::create([
            ...$data,
            'status' => 'confirmed',
        ]);
    }
}
