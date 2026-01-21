<?php

namespace Modules\Checklist\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChecklistSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('checklists')->insert([
            [
                // ===== commonSaasFields =====
                'tenant_id'            => 1,
                'status'               => 1,
                'created_by'           => 1,
                'updated_by'           => 1,
                'created_at'           => now(),
                'updated_at'           => now(),
                'entry_source'         => 'system',
                'entry_source_ref_id'  => null,
                'remark'               => 'Initial checklist seed',
                'system_remark'        => 'Seeder generated record',
                'meta'            => json_encode(['seed' => true]),

                // ===== checklist fields =====
                'checklist_name'       => 'Daily Operations Checklist',
                'checklist_description'=> 'Checklist for daily operational activities',
                'listing_id'           => 1,
                'is_sequence_to_follow'=> 'yes',
                'status_remark'        => 'Active checklist',
                'checklist_by'         => 'Admin',
                'checklist_by_type'    => 'user',
                'checklist_by_id'      => 1,
            ],
            [
                'tenant_id'            => 1,
                'status'               => 1,
                'created_by'           => 1,
                'updated_by'           => 1,
                'created_at'           => now(),
                'updated_at'           => now(),
                'entry_source'         => 'system',
                'entry_source_ref_id'  => null,
                'remark'               => 'Initial checklist seed',
                'system_remark'        => 'Seeder generated record',
                'meta'            => json_encode(['seed' => true]),

                'checklist_name'       => 'Security Checklist',
                'checklist_description'=> 'Checklist for daily security checks',
                'listing_id'           => 2,
                'is_sequence_to_follow'=> 'no',
                'status_remark'        => 'Active checklist',
                'checklist_by'         => 'Admin',
                'checklist_by_type'    => 'user',
                'checklist_by_id'      => 1,
            ],
        ]);
    }
}
