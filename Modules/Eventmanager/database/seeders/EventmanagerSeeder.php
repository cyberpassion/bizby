<?php

namespace Modules\Eventmanager\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventmanagerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('eventmanagers')->insert([
            [
                // ===== commonSaasFields =====
                'client_id'           => 1,
                'status'              => 1,
                'created_by'          => 1,
                'updated_by'          => 1,
                'created_at'          => now(),
                'updated_at'          => now(),
                'entry_source'        => 'system',
                'entry_source_ref_id' => null,
                'remark'              => 'Initial event seed',
                'system_remark'       => 'Seeder generated event',
                'meta'           => json_encode(['seed' => true]),

                // ===== event fields =====
                'event_start_date'    => '2025-01-10',
                'event_end_date'      => '2025-01-12',
                'event_type'          => 'Workshop',
                'event_name'          => 'Laravel Developer Workshop',
                'event_description'   => 'A 3-day workshop focused on Laravel fundamentals and best practices.',
                'participant'         => 'Students',
                'event_participants'  => 'Students, Trainers, Developers',
                'event_remark'        => 'Bring laptops for hands-on sessions',
            ],
            [
                'client_id'           => 1,
                'status'              => 1,
                'created_by'          => 1,
                'updated_by'          => 1,
                'created_at'          => now(),
                'updated_at'          => now(),
                'entry_source'        => 'system',
                'entry_source_ref_id' => null,
                'remark'              => 'Initial event seed',
                'system_remark'       => 'Seeder generated event',
                'meta'           => json_encode(['seed' => true]),

                'event_start_date'    => '2025-02-05',
                'event_end_date'      => null,
                'event_type'          => 'Seminar',
                'event_name'          => 'Career Guidance Seminar',
                'event_description'   => 'Seminar for final year students regarding career opportunities.',
                'participant'         => 'Final Year Students',
                'event_participants'  => 'Students, Faculty',
                'event_remark'        => 'Attendance mandatory',
            ],
        ]);
    }
}
