<?php

namespace Modules\Shared\Database\Seeders\Terms;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermLeadStageSeeder extends Seeder
{
    public function run(): void
    {
        $stages = [
            ['new',        'New'],
            ['contacted',  'Contacted'],
            ['followup',   'Follow-up'],
            ['qualified',  'Qualified'],
            ['converted',  'Converted'],
            ['lost',       'Lost'],
        ];

        $data = [];

        foreach ($stages as $index => [$slug, $label]) {
            $data[] = [
                'tenant_id'  => 1, // default client / tenant
                'status'     => 1,
                'name'       => $label,
                'slug'       => $slug,
                'group'      => 'lead-stages',
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
