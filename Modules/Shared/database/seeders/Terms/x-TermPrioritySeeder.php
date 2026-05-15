<?php

namespace Modules\Shared\Database\Seeders\Terms;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TermPrioritySeeder extends Seeder
{
    public function run(): void
    {
        $priorities = [
            'Low',
            'Average',
            'High',
        ];

        $data = [];

        foreach ($priorities as $index => $priority) {
            $data[] = [
                'tenant_id'  => 1,
                'status'     => 1,
                'name'       => $priority,
                'slug'       => Str::slug($priority), // low, average, high
                'group'      => 'priorities',
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
