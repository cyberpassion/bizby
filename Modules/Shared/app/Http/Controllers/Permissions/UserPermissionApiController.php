<?php

namespace Modules\Shared\Http\Controllers\Permissions;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class UserPermissionApiController extends Controller
{

	public function index(int $userId, int $tenantId)
	{
    	$permissions = DB::table('permission_user_roles as pur')

	        // Get roles
    	    ->join(
        	    'permission_roles as r',
            	'r.id',
	            '=',
    	        'pur.role_id'
        	)

	        // Get role permissions
    	    ->join(
        	    'permission_role_permissions as prp',
            	'prp.role_id',
	            '=',
    	        'r.id'
        	)

	        // Get actual permissions
    	    ->join(
        	    'permission_permissions as p',
            	'p.id',
	            '=',
    	        'prp.permission_id'
        	)

	        // Filter by subscribed tenant modules
    	    ->join('tenant_modules as tm', function ($join) use ($tenantId) {

	            $join->on('tm.module_key', '=', 'p.module')
    	            ->where('tm.tenant_id', $tenantId)
        	        ->where('tm.is_active', 1);

	        })

	        ->where('pur.user_id', $userId)
    	    ->where('pur.tenant_id', $tenantId)

	        ->select(
    	        'p.id',
        	    'p.module',
            	'p.operation',
            	'p.slug',
            	'p.scope'
        	)

	        ->distinct()

	        ->pluck('slug');

	    return response()->json([
			'status' => 'success',
    	    'data' => [
				'tenant_id' 	=> $tenantId,
				'user_id'		=> $userId,
				'permissions'	=> $permissions
			]
    	]);
	}

    // POST /api/users/{user}/permissions
    public function assign(Request $request, int $userId)
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
