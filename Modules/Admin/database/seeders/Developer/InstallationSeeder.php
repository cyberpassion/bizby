<?php

namespace Modules\Admin\Database\Seeders\Developer;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InstallationSeeder extends Seeder
{
    public function run()
    {
        $installations = [
            [
                'tenant_id' => 1,
                'module_id' => 1,
                'module_key' => 'student',
                'app_version' => '1.0.0',
                'build_number' => '100',
                'status' => 'installed',
                'step' => 'module_setup',
                'progress' => 100,
                'php_version' => '8.1',
                'server_ip' => '192.168.1.10',
                'installed_by' => 'John Admin',
                'install_type' => 'saas',
                'modules' => json_encode(['student']),
                'config' => json_encode(['enable_attendance' => true]),
                'logs' => json_encode([]),
                'started_at' => Carbon::now()->subDays(50),
                'finished_at' => Carbon::now()->subDays(49),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id' => 1,
                'module_id' => 2,
                'module_key' => 'finance',
                'app_version' => '1.0.0',
                'build_number' => '101',
                'status' => 'installed',
                'step' => 'module_setup',
                'progress' => 100,
                'php_version' => '8.1',
                'server_ip' => '192.168.1.10',
                'installed_by' => 'John Admin',
                'install_type' => 'saas',
                'modules' => json_encode(['finance']),
                'config' => json_encode([]),
                'logs' => json_encode([]),
                'started_at' => Carbon::now()->subDays(30),
                'finished_at' => Carbon::now()->subDays(29),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('installations')->insert($installations);
    }
}