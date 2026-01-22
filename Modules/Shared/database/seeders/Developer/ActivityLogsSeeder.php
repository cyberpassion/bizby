<?php

namespace Modules\Shared\Database\Seeders\Developer;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityLogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logs = [
            [
                'tenant_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,

                'stimulus' => 'login',
                'module' => 'Authentication',
                'activity' => 'User Login',
                'operation' => 'create',
                'entity_key' => 'user_1',
                'summary' => json_encode(['ip' => '192.168.1.1', 'device' => 'Chrome']),
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,

                'stimulus' => 'update_profile',
                'module' => 'User',
                'activity' => 'Profile Updated',
                'operation' => 'update',
                'entity_key' => 'user_2',
                'summary' => json_encode(['field_changed' => 'email', 'old_value' => 'old@example.com', 'new_value' => 'new@example.com']),
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,

                'stimulus' => 'fee_payment',
                'module' => 'Finance',
                'activity' => 'Fee Payment',
                'operation' => 'create',
                'entity_key' => 'payment_101',
                'summary' => json_encode(['amount' => 2500, 'method' => 'UPI', 'transaction_id' => 'TXN12345']),
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('activity_logs')->insert($logs);
    }
}
