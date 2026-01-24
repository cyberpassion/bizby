<?php

namespace Modules\Admin\Http\Controllers\Billings;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BillingModuleApiController extends Controller
{
    public function index()
    {
		$tenant = request()->attributes->get('resolvedTenant');
        return response()->json([
            'status' => 'success',
            'data'   => DB::table('tenant_modules')
                ->where('tenant_id', $tenant->id)
                ->where('is_active', true)
                ->get()
        ]);
    }

    public function add(Request $request)
    {
		$tenant = request()->attributes->get('resolvedTenant');
        $request->validate([
            'module' => 'required|string',
        ]);

        $module = DB::table('modules')->where('key', $request->module)->first();

        if (! $module) {
            return response()->json(['message' => 'Module not found'], 404);
        }

        DB::table('tenant_modules')->updateOrInsert(
            [
                'tenant_id'  => $tenant->id,
                'module_key' => $module->key,
            ],
            [
                'module_id'   => $module->id,
                'module_name' => $module->name,
                'price'       => $module->price,
                'activated_at'=> now(),
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]
        );

        return response()->json([
            'status'  => 'success',
            'message' => 'Module added'
        ]);
    }

    public function remove(Request $request)
    {
		$tenant = request()->attributes->get('resolvedTenant');
        $request->validate([
            'module' => 'required|string',
        ]);

        DB::table('tenant_modules')
            ->where('tenant_id', $tenant->id)
            ->where('module_key', $request->module)
            ->update([
                'deactivated_at' => now(),
                'is_active'      => false,
                'updated_at'     => now(),
            ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Module removed'
        ]);
    }
}
