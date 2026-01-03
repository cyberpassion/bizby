<?php

namespace Modules\Admin\Http\Controllers\Tenants;

use Illuminate\Http\Request;
use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Shared\Http\Controllers\SharedApiController;

use Illuminate\Support\Facades\DB;

use Stancl\Tenancy\Database\Models\Tenant as TenancyTenant;
use Modules\Shared\Services\TenantDatabaseService;

class TenantAccountApiController extends SharedApiController
{
    protected function model()
    {
        return TenantAccount::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

	public function extraStats()
	{
    	return [
       		'premium_plan' => TenantAccount::where('plan', 'premium')->count()
    	];
	}

	public function storeWithTenancy(Request $request, TenantDatabaseService $dbService)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'plan' => 'nullable|string|max:50',
            'valid_till' => 'nullable|date',
            'settings' => 'nullable|array',
        ]);

        // 1️⃣ Create BUSINESS tenant (central DB)
        $tenantAccount = TenantAccount::create([
            ...$data,
            'status' => 'draft',
        ]);

        // 2️⃣ Decide tenant database name
        $databaseName = 'tenant_' . $tenantAccount->id . '_db';

        // 🔑 Create DB (SQL locally, Plesk on server)
	    $dbService->create($databaseName);

        // 3️⃣ Create TENANCY tenant (infra)
        $tenancyTenant = TenancyTenant::create([
            'id' => 'tenant_' . $tenantAccount->id,
            'data' => [
                'database' => $databaseName,
                'db_host' => config('database.connections.mysql.host'),
                'db_username' => config('database.connections.mysql.username'),
                'db_password' => config('database.connections.mysql.password'),
            ],
        ]);

        // 4️⃣ Link tenancy → business tenant
        $tenantAccount->update([
            'tenancy_id' => $tenancyTenant->id,
        ]);

        // 5️⃣ OPTIONAL: run tenant migrations
        // Artisan::call('tenants:migrate', [
        //     '--tenants' => [$tenancyTenant->id],
        // ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Tenant account created successfully',
            'data' => $tenantAccount,
        ], 201);
    }

}
