<?php

namespace Modules\Admin\Http\Controllers\Tenants;

use Illuminate\Support\Facades\Artisan;

use Illuminate\Http\Request;
use Modules\Shared\Response\ApiResponse;

use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Shared\Http\Controllers\SharedApiController;

use App\Models\Tenant as TenancyTenant;
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
		$tenantId = $tenantAccount->id;
		$databaseName = config('tenancy.database.prefix') . $tenantId . config('tenancy.database.suffix');

        // 3️⃣ Create TENANCY tenant (infra)
        $tenancyTenant = TenancyTenant::create([
            'id' => $tenantId,
			'tenancy_db_name'	=>	$databaseName,
        ]);

		// 🔑 Create DB (SQL locally, Plesk on server)
		// this could be later moved post payment rather than while tenant creation
	    $dbService->create($databaseName);

        // 4️⃣ Link tenancy → business tenant
        $tenantAccount->update([
            'tenancy_id' => $tenancyTenant->id,
        ]);

        // 5️⃣ OPTIONAL: run tenant migrations
        Artisan::call('tenants:migrate', [
            '--tenants' => [$tenancyTenant->id]
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Tenant account created successfully',
            'data' => $tenantAccount,
        ], 201);
    }

}
