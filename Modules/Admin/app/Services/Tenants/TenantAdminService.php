<?php

namespace Modules\Admin\Services\Tenants;

use Modules\Admin\Models\Tenants\TenantAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Stancl\Tenancy\Facades\Tenancy;

class TenantAdminService
{
    public function createCentralAdmin(TenantAccount $tenant): void
    {
        // Ensure central DB context
        Tenancy::end();

        $central = config('tenancy.database.central_connection');

        DB::connection($central)->transaction(function () use ($tenant, $central) {

            // 1️⃣ Create / Update central user
			//$password = Str::random(16);
			$password = 'password';
            $userId = DB::connection($central)
                ->table('users')
                ->updateOrInsert(
                    ['email' => $tenant->email],
                    [
                        'name'        => $tenant->name,
                        'password'    => Hash::make($password),
                        'updated_at'  => now(),
                        'created_at'  => now(),
                    ]
                );

            // Fetch user id (updateOrInsert doesn't return it)
            $user = DB::connection($central)
                ->table('users')
                ->where('email', $tenant->email)
                ->first();

            // 2️⃣ Map user to tenant with role
            DB::connection($central)
                ->table('tenant_users')
                ->updateOrInsert(
                    [
                        'user_id'   => $user->id,
                        'tenant_id' => $tenant->id,
                    ],
                    [
                        'role_id'    => 1,
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
        });
    }
}
