<?php

namespace Modules\Consultation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConsultationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('consultations')->insert([
            [
                'tenant_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'deleted_at' => null,
                'created_at' => now(),
                'updated_at' => now(),

                'entry_source' => 'web',
                'entry_source_ref_id' => null,
                'remark' => 'First consultation entry',
                'system_remark' => null,
                'meta' => json_encode(['ip' => '127.0.0.1']),

                'consultation_group_id' => 10,
                'consultation_date' => '2025-01-15',
                'consultation_time' => '10:30:00',
                'day_token_id' => 5,
                'channel' => 'offline',

                'consultant_type' => 'App\\Models\\User',
                'consultant_id' => 1,

                'reason' => 'Routine health check-up',

                // Person Fields
                'name' => 'Rahul Kumar',
                'gender' => 'Male',
                'dob' => '1995-06-12',
                'age' => 29,
                'phone' => '9876543210',
                'email' => 'rahul@example.com',
                'verification_id_name' => 'Aadhar',
                'verification_id_number' => '1234-5678-9012',
                'address' => 'Delhi, India',
                'religion' => 'Hindu',
                'caste' => 'General',
                'category' => 'General',
                'nationality' => 'Indian',
                'marital_status' => 1,

                // Other fields
                'consultation_type' => 'General OPD',
                'consultation_fee' => 500.00,
                'referred_by' => 'Self',
                'referred_to' => 'Dr. Sharma',
                'followup_interval_days' => '10',
                'next_date' => '2025-01-25',
                'thread_parent' => null,
            ],
        ]);
    }
}
