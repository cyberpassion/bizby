<?php

namespace Modules\Announcement\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $announcements = [
            [
                'tenant_id' => 1,
                'status' => 1,
                'announcement_id' => null,

                'session' => '2024-2025',
                'month' => 'April',
                'end_date' => now()->addDays(15),

                'category' => 'General',
                'recipient' => 'All',

                'announcement' => 'School will remain closed on account of local festival.',

                'added_by_type' => 'System',
                'added_by_id' => null,
                'added_by' => 'Admin',

                'created_by' => 1,
                'updated_by' => 1,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id' => 1,
                'status' => 1,
                'announcement_id' => null,

                'session' => '2024-2025',
                'month' => 'May',
                'end_date' => now()->addDays(30),

                'category' => 'Exam',
                'recipient' => 'Students',

                'announcement' => 'Final examination schedule will be announced soon.',

                'added_by_type' => 'Employee',
                'added_by_id' => 5,
                'added_by' => 'Examination Department',

                'created_by' => 1,
                'updated_by' => 1,

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($announcements as $data) {
            DB::table('announcements')->updateOrInsert(
                [
                    'announcement' => $data['announcement'],
                    'session' => $data['session'],
                ],
                $data
            );
        }
    }
}
