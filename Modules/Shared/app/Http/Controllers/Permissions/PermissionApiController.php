<?php

namespace Modules\Shared\Http\Controllers\Permissions;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PermissionApiController extends Controller
{
    // GET /api/permissions
    public function index()
    {
        return DB::table('permission_permissions')->get();
    }

	
    // POST /api/permissions
    public function store(Request $request)
    {
        $data = $request->validate([
            'module' => 'required|string',
            'operation' => 'required|string',
            'slug' => 'required|string|unique:permission_permissions,slug',
            'scope' => 'nullable|string',
            'parent_id' => 'nullable|exists:permission_permissions,id'
        ]);

        DB::table('permission_permissions')->insert([
            ...$data,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['status'=>'success', 'message' => 'Permission created']);
    }

    // DELETE /api/permissions/{id}
    public function destroy($id)
    {
        DB::table('permission_permissions')->where('id', $id)->delete();
        return response()->json(['status'=>'success', 'message' => 'Permission deleted']);
    }

	public function get($id)
	{
    	//$user   = auth()->user();            // current user
	    $tenant = app('resolvedTenant');;      // current tenant

	    //$userId   = $user->id;
    	//$tenantId = $tenant->id;
		$userId = $id;
		$tenantId = $tenant->id;

	    /*
    	|--------------------------------------------------------------------------
	    | 1️⃣ Permissions via ROLES
    	|--------------------------------------------------------------------------
	    */
    	$rolePermissions = DB::table('permission_roles as r')
	        ->join('permission_role_permissions as rp', 'rp.role_id', '=', 'r.id')
    	    ->join('permission_permissions as p', 'p.id', '=', 'rp.permission_id')
        	->where('r.tenant_id', $tenantId)
        	->whereIn('r.id', function ($q) use ($userId) {
            	$q->select('role_id')
              	->from('permission_user_roles')
              	->where('user_id', $userId);
	        })
    	    ->select('p.slug', 'rp.scope')
        	->get();

	    /*
	    |--------------------------------------------------------------------------
    	| 2️⃣ Direct USER permissions
    	|--------------------------------------------------------------------------
	    */
    	$userPermissions = DB::table('permission_user_permissions as up')
        	->join('permission_permissions as p', 'p.id', '=', 'up.permission_id')
	        ->where('up.user_id', $userId)
    	    ->where('up.tenant_id', $tenantId)
        	->select('p.slug', 'up.scope')
        	->get();

	    /*
    	|--------------------------------------------------------------------------
    	| 3️⃣ Merge + normalize
    	|--------------------------------------------------------------------------
	    */
    	$final = [];

	    foreach ($rolePermissions->merge($userPermissions) as $row) {
    	    $final[$row->slug][] = $row->scope ?? 'global';
    	}

	    $data = [];

	    foreach ($final as $slug => $scopes) {
    	    $data[] = [
        	    'slug'   => $slug,
            	'scopes' => array_values(array_unique($scopes)),
	        ];
    	}

	    return response()->json([
    	    'status' => true,
        	'data'   => $data,
	    ]);
	}

}
