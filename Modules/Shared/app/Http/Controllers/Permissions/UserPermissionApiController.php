<?php

namespace Modules\Shared\Http\Controllers\Permissions;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class UserPermissionApiController extends Controller
{
    // POST /api/users/{user}/permissions
    public function assign(Request $request, $userId)
    {
        $request->validate([
            'permission_ids' => 'required|array'
        ]);

        foreach ($request->permission_ids as $pid) {
            DB::table('permission_user_permissions')->updateOrInsert([
                'user_id' => $userId,
                'permission_id' => $pid,
                'tenant_id' => tenant()->id,
            ], [
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        Cache::forget("permissions:" . tenant()->id . ":" . $userId);

        return response()->json(['message' => 'User permissions assigned']);
    }

    // DELETE /api/users/{user}/permissions
    public function revoke(Request $request, $userId)
    {
        DB::table('permission_user_permissions')
            ->where('user_id', $userId)
            ->where('tenant_id', tenant()->id)
            ->whereIn('permission_id', $request->permission_ids)
            ->delete();

        Cache::forget("permissions:" . tenant()->id . ":" . $userId);

        return response()->json(['message' => 'User permissions removed']);
    }
}
