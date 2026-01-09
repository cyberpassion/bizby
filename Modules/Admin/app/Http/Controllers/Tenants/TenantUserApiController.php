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

	public function provisionUser(Request $request)
	{

	    $data = $request->validate([
    	    'name'     => 'required|string|max:255',
        	'email'    => 'required|email',
        	'password' => 'required|string|min:6',
        	'role'     => 'required|string',
	    ]);

	    // 1️⃣ Get tenancy tenant (stancl)
    	$tenancyTenantId = tenant('id'); // e.g. tenant_1

	    if (! $tenancyTenantId) {
    	    return response()->json([
        	    'status'  => 'error',
            	'message' => 'Tenant context missing',
	        ], 400);
    	}

	    // 2️⃣ Resolve BUSINESS tenant
    	$tenantAccount = TenantAccount::where('tenancy_id', $tenancyTenantId)->first();

	    if (! $tenantAccount) {
    	    return response()->json([
        	    'status'  => 'error',
            	'message' => 'Tenant account not found',
	        ], 404);
    	}

	    return DB::transaction(function () use ($data, $tenantAccount) {

	        // 3️⃣ Create or reuse global user
    	    $user = User::firstOrCreate(
        	    ['email' => $data['email']],
            	[
                	'name'     => $data['name'],
                	'password' => Hash::make($data['password']),
	            ]
    	    );

	        // 4️⃣ Assign user to tenant
    	    $tenantUser = TenantUser::updateOrCreate(
        	    [
            	    'tenant_id' => $tenantAccount->id,
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
    	            'tenant'      => $tenantAccount->only(['id', 'name']),
        	    ],
        	], 201);
	    });
	}

}
