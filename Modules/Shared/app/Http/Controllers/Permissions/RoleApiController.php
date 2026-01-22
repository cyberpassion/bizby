<?php

namespace Modules\Shared\Http\Controllers\Permissions;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class RoleApiController extends Controller
{
    // GET /api/roles
    public function index()
    {
        return DB::table('permission_roles')
            ->where('tenant_id', tenant()->id)
            ->get();
    }

    // POST /api/roles
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        DB::table('permission_roles')->insert([
            'name' => $request->name,
            'tenant_id' => tenant()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['status'=>'success', 'message' => 'Role created']);
    }

    // DELETE /api/roles/{id}
    public function destroy($id)
    {
        DB::table('permission_roles')
            ->where('id', $id)
            ->where('tenant_id', tenant()->id)
            ->delete();

        return response()->json(['status'=>'success', 'message' => 'Role deleted']);
    }
}
