<?php

namespace Modules\Shared\Database\Seeders\Terms;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermLeadStageFollowupSeeder extends Seeder
{
    public function run(): void
    {
        $followups = [
            ['interested',        'Interested'],
            ['not_interested',    'Not Interested'],
            ['callback',          'Call Back Later'],
            ['no_response',       'No Response'],
            ['meeting_scheduled', 'Meeting Scheduled'],
            ['proposal_sent',     'Proposal Sent'],
            ['converted',         'Converted'],
            ['lost',              'Lost'],
        ];

        $data = [];

        foreach ($followups as $index => [$slug, $label]) {
            $data[] = [
                'tenant_id'  => 1, // default tenant
                'status'     => 1,
                'name'       => $label,
                'slug'       => $slug,
                'group'      => 'lead-followup-outcomes',
                'module'     => 'lead',
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->upsert(
            $data,
            ['slug', 'tenant_id'],
            ['status', 'updated_at']
        );
    }
}