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
        // Force central context
        Tenancy::end();

        DB::connection(config('tenancy.database.central_connection'))
            ->table('users')
            ->updateOrInsert(
                ['email' => $tenant->email],
                [
                    'name'       => $tenant->name,
                    'password'   => Hash::make(Str::random(16)),
                    //'role'       => 'admin',
                    //'tenant_id'  => $tenant->id,
                    'updated_at'=> now(),
                    'created_at'=> now(),
                ]
            );
    }
}
