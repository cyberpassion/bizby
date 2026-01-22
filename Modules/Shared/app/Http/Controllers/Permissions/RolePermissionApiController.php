<?php

namespace Modules\Shared\Http\Controllers\Permissions;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class RolePermissionApiController extends Controller
{
    // POST /api/roles/{role}/permissions
    public function assign(Request $request, $roleId)
    {
        $request->validate([
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permission_permissions,id'
        ]);

        foreach ($request->permission_ids as $pid) {
            DB::table('permission_role_permissions')->updateOrInsert(
                ['role_id' => $roleId, 'permission_id' => $pid],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }

        Cache::tags(['permissions'])->flush();

        return response()->json(['message' => 'Permissions assigned']);
    }

    // DELETE /api/roles/{role}/permissions
    public function revoke(Request $request, $roleId)
    {
        DB::table('permission_role_permissions')
            ->where('role_id', $roleId)
            ->whereIn('permission_id', $request->permission_ids)
            ->delete();

        Cache::tags(['permissions'])->flush();

        return response()->json(['message' => 'Permissions removed']);
    }
}
