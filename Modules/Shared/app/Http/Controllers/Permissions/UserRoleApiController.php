<?php

namespace Modules\Shared\Http\Controllers\Permissions;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class UserRoleApiController extends Controller
{
    public function index($userId)
    {
        $tenant = request()->attributes->get('resolvedTenant');

        $roles = DB::table('permission_user_roles as pur')
            ->join('permission_roles as r', 'r.id', '=', 'pur.role_id')
            ->where('pur.user_id', $userId)
            ->where('r.tenant_id', $tenant->id)
            ->select('r.id')
            ->get();

        return response()->json([
            'data' => $roles
        ]);
    }

    // POST /api/users/{user}/roles
    public function assign(Request $request, $userId)
    {
        $request->validate([
            'role_ids' => 'required|array'
        ]);

        $tenant = request()->attributes->get('resolvedTenant');

        foreach ($request->role_ids as $rid) {
            DB::table('permission_user_roles')->updateOrInsert([
                'user_id' => $userId,
                'role_id' => $rid
            ]);
        }

        // clear cached permissions for this user + tenant
        Cache::forget("permissions:{$tenant->id}:{$userId}");

        return response()->json([
            'message' => 'Roles assigned successfully'
        ]);
    }

    // DELETE /api/users/{user}/roles
    public function revoke(Request $request, $userId)
    {
        $request->validate([
            'role_ids' => 'required|array'
        ]);

        $tenant = request()->attributes->get('resolvedTenant');

        DB::table('permission_user_roles')
            ->where('user_id', $userId)
            ->whereIn('role_id', $request->role_ids)
            ->delete();

        // clear cached permissions for this user + tenant
        Cache::forget("permissions:{$tenant->id}:{$userId}");

        return response()->json([
            'message' => 'Roles removed successfully'
        ]);
    }
}
