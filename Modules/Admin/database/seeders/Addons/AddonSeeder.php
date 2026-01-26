<?php

namespace Modules\Admin\Database\Seeders\Addons;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AddonSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $addons = [
            [
                'key' => 'calendar',
                'name' => 'Calendar',
                'description' => 'Calendar addon',
                'price' => null,
                'billing_cycle' => 'yearly',
                'is_active' => true,
            ],
            [
                'key' => 'upload',
                'name' => 'Uploads',
                'description' => 'Uploads addon',
                'price' => null,
                'billing_cycle' => 'yearly',
                'is_active' => true,
            ]
        ];

        DB::table('addons')->upsert(
            collect($addons)->map(fn ($addon) => [
                ...$addon,
                'created_at' => $now,
                'updated_at' => $now,
            ])->toArray(),
            ['key'], // unique column
            ['name', 'description', 'price', 'billing_cycle', 'is_active', 'updated_at']
        );
    }
}
