<?php

namespace Modules\Shared\Http\Controllers\Permissions;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class RolePermissionApiController extends Controller
{
    /**
     * GET /api/roles/{role}/permissions
     * List permissions assigned to role
     */
    public function index($roleId)
    {
        $tenant = request()->attributes->get('resolvedTenant');

        $permissions = DB::table('permission_role_permissions as rpp')
            ->join('permission_permissions as p', 'p.id', '=', 'rpp.permission_id')
            ->join('permission_roles as r', 'r.id', '=', 'rpp.role_id')
            ->where('rpp.role_id', $roleId)
            ->where('r.tenant_id', $tenant->id)
            ->select([
                'p.id',
                'p.module',
                'p.operation',
                'p.slug',
                'rpp.scope'
            ])
            ->orderBy('p.module')
            ->orderBy('p.operation')
            ->get();

        return response()->json([
			'status' => 'success',
            'data' => $permissions
        ]);
    }

    /**
     * PUT /api/roles/{role}/permissions
     * Sync (replace) permissions for role
     */
    public function sync(Request $request, $roleId)
    {
        $request->validate([
            'permission_ids'   => 'required|array',
            'permission_ids.*' => 'exists:permission_permissions,id',
        ]);

        $tenant = request()->attributes->get('resolvedTenant');

        // safety: ensure role belongs to tenant
        $belongsToTenant = DB::table('permission_roles')
            ->where('id', $roleId)
            ->where('tenant_id', $tenant->id)
            ->exists();

        if (! $belongsToTenant) {
            return response()->json([
                'message' => 'Role does not belong to tenant'
            ], 403);
        }

        DB::transaction(function () use ($request, $roleId) {

            DB::table('permission_role_permissions')
                ->where('role_id', $roleId)
                ->delete();

            $rows = collect($request->permission_ids)->map(fn ($pid) => [
                'role_id'       => $roleId,
                'permission_id' => $pid,
                'created_at'    => now(),
                'updated_at'    => now(),
            ])->toArray();

            if (! empty($rows)) {
                DB::table('permission_role_permissions')->insert($rows);
            }
        });

        // flush all permission caches (safe for role change)
        Cache::tags(['permissions'])->flush();

        return response()->json([
            'message' => 'Role permissions synced successfully'
        ]);
    }
}
