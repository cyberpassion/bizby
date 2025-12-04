<?php

namespace Modules\Note\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notes')->insert([
            [
                // SaaS Common Fields
                'client_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,

                // Entry Source
                'entry_source' => 'web',
                'entry_source_ref_id' => null,

                // Remarks
                'remark' => 'Initial test note',
                'system_remark' => 'Seeder generated',
                'meta_info' => json_encode([
                    'ip' => '127.0.0.1',
                    'device' => 'Laptop',
                    'browser' => 'Chrome'
                ]),

                // Session
                'session' => '2024-2025',

                // Added For
                'added_for_id' => 10,
                'added_for_type' => 'customer',
                'added_for' => 'Customer Name',

                // Added By
                'added_by_id' => 1,
                'added_by_type' => 'admin',
                'added_by' => 'System Admin',

                // Note Details
                'note_type' => 'info',
                'subject' => 'Task Update',
                'information' => 'This is a seeded note for module testing.',
                'context' => 'lead',

                // Context (Required)
                'context_type' => 'lead',
                'context_id' => 10,
                'context_type_id' => null,

                // Threading
                'thread_parent' => 0,

                // Dates
                'note_end_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'note_end_time' => '15:00:00'
            ],
        ]);
    }
}
