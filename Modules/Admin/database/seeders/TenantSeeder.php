<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TenantSeeder extends Seeder
{
    public function run()
    {
        $tenants = [
            [
                'name' => 'Alpha University',
                //'code' => 'ALPHAUNI',
                'domain' => 'alphauni.edu',
                'email' => 'info@alphauni.edu',
                'phone' => '9876543210',
                'plan' => 'premium',
                'valid_till' => Carbon::now()->addYear(),
                'is_active' => true,
                'settings' => json_encode(['theme' => 'blue']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Beta College',
                //'code' => 'BETACOL',
                'domain' => 'betacollege.edu',
                'email' => 'admin@betacollege.edu',
                'phone' => '9123456780',
                'plan' => 'basic',
                'valid_till' => Carbon::now()->addMonths(6),
                'is_active' => true,
                'settings' => json_encode(['theme' => 'green']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tenants')->insert($tenants);
    }
}