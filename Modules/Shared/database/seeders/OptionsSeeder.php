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
                'option_name' => 'site_name',
                'option_value' => 'My SaaS App',
                'autoload' => 'yes',
            ],
            [
                'option_name' => 'site_email',
                'option_value' => 'support@mysaasapp.com',
                'autoload' => 'yes',
            ],
            [
                'option_name' => 'timezone',
                'option_value' => 'Asia/Kolkata',
                'autoload' => 'yes',
            ],
            [
                'option_name' => 'currency',
                'option_value' => 'INR',
                'autoload' => 'yes',
            ],
        ];

        foreach ($options as $option) {
            DB::table('options')->updateOrInsert(
                ['option_name' => $option['option_name']], // check by option_name
                array_merge($option, [
                    'client_id' => 1,
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
