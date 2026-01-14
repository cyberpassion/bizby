<?php

namespace Modules\Admin\Http\Controllers\Tenants;

use \Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Admin\Models\Tenants\TenantUser;
use Modules\Shared\Http\Controllers\SharedChildApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class TenantUserApiController extends SharedChildApiController
{
    protected function parentModel()
    {
        return TenantAccount::class;
    }

    protected function childModel()
    {
        return TenantUser::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }

	public function provisionUser(Request $request, int $tenantId)
	{
	    // 1️⃣ Validate request
    	$data = $request->validate([
        	'name'     => 'required|string|max:255',
	        'email'    => 'required|email',
    	    'password' => 'required|string|min:6',
        	'role'     => 'required|string',
	    ]);

	    // 2️⃣ Get resolved tenant from middleware (AUTHORITATIVE)
    	$tenant = app('resolvedTenant');

	    if (! $tenant) {
    	    return response()->json([
        	    'status'  => 'error',
            	'message' => 'Tenant context missing',
	        ], 400);
    	}

	    // 3️⃣ SECURITY CHECK: URL tenant must match header tenant
    	if ((int) $tenantId !== (int) $tenant->id) {
        	return response()->json([
            	'status'  => 'error',
            	'message' => 'Tenant mismatch',
	        ], 403);
    	}

	    // 4️⃣ Provision user safely (CENTRAL DB)
    	return DB::transaction(function () use ($data, $tenant) {

	        // Create or reuse global user
    	    $user = User::firstOrCreate(
        	    ['email' => $data['email']],
            	[
                	'name'     => $data['name'],
                	'password' => Hash::make($data['password']),
	            ]
    	    );

	        // Assign user to tenant
    	    $tenantUser = TenantUser::updateOrCreate(
        	    [
            	    'tenant_id' => $tenant->id,
                	'user_id'   => $user->id,
	            ],
    	        [
        	        'role'      => $data['role'],
            	    'is_active' => true,
            	]
        	);

	        return response()->json([
    	        'status'  => 'success',
        	    'message' => 'User provisioned successfully',
            	'data'    => [
                	'user'        => $user,
            	    'tenant_user' => $tenantUser,
                	'tenant'      => $tenant->only(['id', 'name']),
	            ],
    	    ], 201);
    	});
	}

}
