<?php

namespace Modules\Shared\Database\Seeders\Terms;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermTimeZoneSeeder extends Seeder
{
    public function run(): void
    {
        $timezones = [
            ['Asia/Kolkata', 'Indian Standard Time'],
            ['UTC', 'Coordinated Universal Time'],
            ['Asia/Dubai', 'Gulf Standard Time'],
            ['Europe/London', 'British Time'],
            ['Europe/Paris', 'Central European Time'],
            ['America/New_York', 'Eastern Time (US)'],
            ['America/Chicago', 'Central Time (US)'],
            ['America/Denver', 'Mountain Time (US)'],
            ['America/Los_Angeles', 'Pacific Time (US)'],
            ['Australia/Sydney', 'Australian Eastern Time'],
            ['Asia/Singapore', 'Singapore Time'],
            ['Asia/Tokyo', 'Japan Time'],
            ['Asia/Shanghai', 'China Standard Time'],
        ];

        $data = [];

        foreach ($timezones as $index => [$tz, $label]) {
            $data[] = [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => $label,
                'slug'       => strtolower(str_replace('/', '-', $tz)),
                'group'      => 'timezones',
                'module'     => 'shared',
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
