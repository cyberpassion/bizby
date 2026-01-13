<?php

namespace Modules\Admin\Http\Controllers\Tenants;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Shared\Http\Controllers\SharedApiController;
use Modules\Admin\Services\Tenants\TenantDatabaseService;
use Modules\Admin\Jobs\Tenants\ProvisionTenantJob;

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

	// Create Tenant Account
    public function storeWithTenancy(Request $request, TenantDatabaseService $dbService)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'domain'     => 'nullable|string|max:255',
            'email'      => 'nullable|email',
            'phone'      => 'nullable|string|max:20',
            'plan'       => 'nullable|string|max:50',
            'valid_till' => 'nullable|date',
            'settings'   => 'nullable|array',
        ]);

        // 1️⃣ Create BUSINESS tenant (central DB)
        $tenantAccount = TenantAccount::create([
            ...$data,
            'status' => 'draft',
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Tenant account created successfully',
            'data'    => $tenantAccount->fresh(),
        ], 201);
    }

	// Provision Tenant - Create database, migrate, create user and all
    public function paymentCompleted(TenantAccount $tenant)
	{
    	$tenant->update(['status' => 'paid']);

	    ProvisionTenantJob::dispatch($tenant->id);

	    return response()->json([
    	    'status'  => 'paid',
        	'message' => 'Payment received. Provisioning has started.',
	    ]);
	}

	public function provisionForTesting(TenantAccount $tenant)
	{
    	if (app()->environment('production')) {
        	abort(404);
   		}

	    if (! in_array($tenant->status, ['paid', 'failed', 'draft'])) {
    	    return response()->json([
        	    'status'  => 'invalid_state',
            	'message' => 'Tenant cannot be provisioned in current state',
	        ], 409);
    	}

	    ProvisionTenantJob::dispatch($tenant->id);

	    return response()->json([
    	    'status'  => 'provisioning',
        	'message' => 'Provisioning started (testing only)',
	    ]);
	}

}
