<?php

namespace Modules\Shared\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            [
                'name' => 'site_name',
                'value' => 'My SaaS App',
                'autoload' => 'yes',
            ],
            [
                'name' => 'site_email',
                'value' => 'support@mysaasapp.com',
                'autoload' => 'yes',
            ],
            [
                'name' => 'timezone',
                'value' => 'Asia/Kolkata',
                'autoload' => 'yes',
            ],
            [
                'name' => 'currency',
                'value' => 'INR',
                'autoload' => 'yes',
            ],
        ];

        foreach ($options as $option) {
            DB::table('options')->updateOrInsert(
                ['name' => $option['name']], // check by name
                array_merge($option, [
                    'tenant_id' => 1,
                    'status' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
