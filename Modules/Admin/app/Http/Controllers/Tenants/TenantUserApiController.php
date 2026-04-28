<?php

namespace Modules\Admin\Http\Controllers\Tenants;

use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Admin\Models\Tenants\TenantUser;
use Modules\Shared\Http\Controllers\SharedChildApiController;

use Illuminate\Http\Request;

use Modules\Admin\Services\UserProvisionService;


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

    /**
     * POST /tenants/{tenantId}/users
     * Create (provision) user in tenant
     */
    public function provisionUser(Request $request, int $tenantId)
	{
    	$data = $request->validate([
	        'name'     => 'required|string|max:255',
    	    'email'    => 'required|email',
        	'password' => 'required|string|min:6',
        	'role_id'  => 'required|integer',
	    ]);

	    $tenant = app('resolvedTenant');

	    if (!$tenant || $tenant->id != $tenantId) {
    	    return response()->json(['message' => 'Tenant mismatch'], 403);
    	}

	    $service = app(UserProvisionService::class);

	    // 🔥 1. global user
    	$user = $service->createOrGetUser($data);

	    // 🔥 2. tenant user
    	$tenantUser = $service->createTenantUser(
	        $user,
    	    $tenant->id,
        	$data['role_id']
	    );

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'User Created Successfully',
	        'data'    => $tenantUser
    	], 201);
	}

    /**
     * PUT /tenants/{tenantId}/users/{id}
     * Update tenant user (role / status)
     */
    public function updateUser(Request $request, int $tenantId, int $id)
	{
    	$data = $request->validate([
        	'role_id'   => 'sometimes|integer',
	        'is_active' => 'sometimes|boolean'
    	]);

	    $tenant = app('resolvedTenant');

	    if (!$tenant || $tenant->id != $tenantId) {
    	    return response()->json(['message' => 'Tenant mismatch'], 403);
    	}

	    $tenantUser = TenantUser::where('tenant_id', $tenant->id)
    	    ->where('id', $id)
        	->firstOrFail();

	    $service = app(UserProvisionService::class);

	    $tenantUser = $service->updateTenantUser($tenantUser, $data);

	    return response()->json([
    	    'status' => 'success',
        	'data'   => $tenantUser
	    ]);
	}

    /**
     * DELETE /tenants/{tenantId}/users/{id}
     * Deactivate tenant user (safe delete)
     */
    public function destroyUser(int $tenantId, int $id)
	{
    	$tenant = app('resolvedTenant');

	    if (!$tenant || $tenant->id != $tenantId) {
    	    return response()->json(['message' => 'Tenant mismatch'], 403);
    	}

	    $tenantUser = TenantUser::where('tenant_id', $tenant->id)
    	    ->where('id', $id)
        	->firstOrFail();

	    $service = app(UserProvisionService::class);

	    $service->deactivateTenantUser($tenantUser);

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'User deactivated'
	    ]);
	}


}
