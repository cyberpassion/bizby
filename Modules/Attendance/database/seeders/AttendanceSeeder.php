<?php

namespace Modules\Attendance\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('attendances')->insert([

            [
                // SaaS common fields
                'client_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'entry_source' => 'web',
                'entry_source_ref_id' => null,
                'remark' => 'Attendance entry created manually',
                'system_remark' => null,
                'meta_info' => json_encode(['ip' => '127.0.0.1']),

                // Module-specific fields
                'absent_date' => '2025-02-01',
                'session' => '2024-2025',
                'month' => 'February',
                'absent_date_part' => 'Morning',
                'absent_duration' => 4.0, // hours

                'absentee_type' => 'employee',   // can be employee/student etc.
                'absentee_id' => 'E12345',

                'absent_code' => 'SICK',
                'absent_reason' => 'Flu and fever',
                'is_paid' => 1, // paid leave
            ],

            [
                'client_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'entry_source' => 'system',
                'entry_source_ref_id' => null,
                'remark' => 'Auto-marked attendance',
                'system_remark' => 'Late entry detected by system',
                'meta_info' => json_encode(['device' => 'mobile']),

                'absent_date' => '2025-02-02',
                'session' => '2024-2025',
                'month' => 'February',
                'absent_date_part' => 'Full Day',
                'absent_duration' => 8.0,

                'absentee_type' => 'student',
                'absentee_id' => 'STU9021',

                'absent_code' => 'UNAUTH',
                'absent_reason' => 'No information',
                'is_paid' => 0, // unpaid
            ]

        ]);
    }
}
