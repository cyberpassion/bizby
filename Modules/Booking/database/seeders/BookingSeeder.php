<?php

namespace Modules\Booking\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = [
            [
                // ===== SaaS common fields =====
                'tenant_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,

                // ===== Booking group =====
                'booking_group_id' => null,
                'booking_id_sno' => 1001,

                // ===== Building / Occupant =====
                'building_id' => 1,
                'occupant_id' => 10,
                'occupant_type' => 'Student',
                'booking_type' => 'Room',

                // ===== Slot =====
                'slot_id' => null,

                // ===== Booking done by =====
                'booking_done_by_type' => 'Employee',
                'booking_done_by' => 'Reception Desk',
                'booking_done_by_mobile' => '9999999999',
                'booking_done_by_email' => 'reception@example.com',

                // ===== Space =====
                'space_id' => 1,
                'max_occupant_count' => 2,

                // ===== Features =====
                'features' => 'AC, WiFi, Attached Bathroom',

                // ===== Check-in =====
                'expected_checkin_datetime' => now()->addDay(),
                'checkin_datetime' => null,
                'checkin_done_by' => 1,
                'checkin_remark' => null,

                // ===== Check-out =====
                'expected_checkout_datetime' => now()->addDays(2),
                'checkout_datetime' => null,
                'checkout_done_by' => 1,
                'checkout_remark' => null,

                // ===== Status flags =====
                'is_checked_out' => 0,
                'is_cash_verified' => 0,

                // ===== Cash verification =====
                'cash_verified_by' => 0,
                'cash_verification_remark' => null,

                // ===== Timestamps =====
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($bookings as $data) {
            DB::table('bookings')->updateOrInsert(
                [
                    'booking_id_sno' => $data['booking_id_sno'],
                    'tenant_id' => $data['tenant_id'],
                ],
                $data
            );
        }
    }
}
