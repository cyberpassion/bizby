<?php

namespace Modules\Admin\Http\Controllers\Tenants;

use Modules\Admin\Models\Tenants\TenantAccount;
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

    /**
     * POST /tenants/{tenantId}/users
     * Create (provision) user in tenant
     */
    public function storeUser(Request $request, int $tenantId)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
            'role_id'  => 'required|integer'
        ]);

        $tenant = app('resolvedTenant');
        if (!$tenant || $tenant->id != $tenantId) {
            return response()->json(['message' => 'Tenant mismatch'], 403);
        }

        return DB::transaction(function () use ($data, $tenant) {

            // Global user
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'     => $data['name'],
                    'password' => Hash::make($data['password']),
                ]
            );

            // Validate role
            $role = DB::table('permission_roles')
                ->where('name', $data['role_id'])
                ->where('tenant_id', $tenant->id)
                ->first();

            if (!$role) {
                abort(422, 'Invalid role');
            }

            // Tenant scoped user
            $tenantUser = TenantUser::updateOrCreate(
                [
                    'tenant_id' => $tenant->id,
                    'user_id'   => $user->id,
                ],
                [
                    'role_id'      => $role->name,
                    'is_active' => true,
                ]
            );

            return response()->json([
                'status' => 'success',
                'data'   => $tenantUser
            ], 201);
        });
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

        if (isset($data['role_id'])) {
            $role = DB::table('permission_roles')
                ->where('name', $data['role_id'])
                ->where('tenant_id', $tenant->id)
                ->first();

            if (!$role) abort(422, 'Invalid role');
        }

        $tenantUser->update($data);

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

        $tenantUser->update(['is_active' => false]);

        return response()->json([
            'status'  => 'success',
            'message' => 'User deactivated'
        ]);
    }
}
