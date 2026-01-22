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
}
