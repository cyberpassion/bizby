<?php

namespace Modules\Shared\Http\Controllers\Permissions;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class UserRoleApiController extends Controller
{
    // POST /api/users/{user}/roles
    public function assign(Request $request, $userId)
    {
        $request->validate([
            'role_ids' => 'required|array'
        ]);

        foreach ($request->role_ids as $rid) {
            DB::table('permission_user_roles')->updateOrInsert([
                'user_id' => $userId,
                'role_id' => $rid
            ]);
        }

        Cache::forget("permissions:" . tenant()->id . ":" . $userId);

        return response()->json(['message' => 'Roles assigned']);
    }

    // DELETE /api/users/{user}/roles
    public function revoke(Request $request, $userId)
    {
        DB::table('permission_user_roles')
            ->where('user_id', $userId)
            ->whereIn('role_id', $request->role_ids)
            ->delete();

        Cache::forget("permissions:" . tenant()->id . ":" . $userId);

        return response()->json(['message' => 'Roles removed']);
    }
}
