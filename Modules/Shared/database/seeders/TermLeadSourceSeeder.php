<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermLeadSourceSeeder extends Seeder
{
    public function run(): void
    {
        $sources = [
            'Walk-in',
            'Phone Call',
            'Website',
            'Google Search',
            'Google Ads',
            'Facebook',
            'Instagram',
            'WhatsApp',
            'Email',
            'Referral',
            'Agent',
            'Advertisement',
            'Event / Seminar',
            'Campaign',
            'Justdial',
            'Indiamart',
            'Sulekha',
            'Other',
        ];

        $data = [];

        foreach ($sources as $index => $source) {
            $data[] = [
                'client_id'  => 1,
                'status'     => 1,
                'name'       => $source,
                'slug'       => Str::slug($source),
                'group'      => 'lead-sources',
                'module'     => 'lead',
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('terms')->upsert(
            $data,
            ['slug', 'client_id'],
            ['status', 'updated_at']
        );
    }
}
