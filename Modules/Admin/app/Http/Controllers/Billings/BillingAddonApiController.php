<?php

namespace Modules\Admin\Http\Controllers\Billings;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BillingAddonApiController extends Controller
{
    public function index()
    {
		$tenant = request()->attributes->get('resolvedTenant');
        return response()->json([
            'status' => 'success',
            'data'   => DB::table('tenant_addons')
                ->where('tenant_id', $tenant->id)
                ->where('is_active', true)
                ->get()
        ]);
    }

    public function add(Request $request)
    {
		$tenant = request()->attributes->get('resolvedTenant');
        $request->validate([
            'addon' => 'required|string',
        ]);

        $addon = DB::table('addons')->where('key', $request->addon)->first();

        if (! $addon) {
            return response()->json(['message' => 'Addon not found'], 404);
        }

        DB::table('tenant_addons')->updateOrInsert(
            [
                'tenant_id' => $tenant->id,
                'addon_key' => $addon->key,
            ],
            [
                'addon_id'     => $addon->id,
                'addon_name'   => $addon->name,
                'price'        => $addon->price,
                'activated_at' => now(),
                'is_active'    => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]
        );

        return response()->json([
            'status'  => 'success',
            'message' => 'Addon added'
        ]);
    }

    public function remove(Request $request)
    {
		$tenant = request()->attributes->get('resolvedTenant');
        $request->validate([
            'addon' => 'required|string',
        ]);

        DB::table('tenant_addons')
            ->where('tenant_id', $tenant->id)
            ->where('addon_key', $request->addon)
            ->update([
                'deactivated_at' => now(),
                'is_active'      => false,
                'updated_at'     => now(),
            ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Addon removed'
        ]);
    }
}
