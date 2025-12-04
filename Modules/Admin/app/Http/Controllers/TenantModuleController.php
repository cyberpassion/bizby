<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Modules\Admin\Models\TenantModule;
use Modules\Admin\Models\Installation;

class TenantModuleController extends Controller
{
    public function index($tenantId)
    {
        return TenantModule::where('tenant_id', $tenantId)->get();
    }

    public function activate(Request $request, $tenantId)
    {
        $request->validate([
            'module_key' => 'required|string',
            'module_name' => 'required|string',
            'is_paid' => 'boolean',
            'price' => 'nullable|numeric',
            'valid_till' => 'nullable|date',
            'config' => 'nullable|json'
        ]);

        $module = TenantModule::create([
            'tenant_id' => $tenantId,
            'module_key' => $request->module_key,
            'module_name' => $request->module_name,
            'activated_at' => now(),
            'is_paid' => $request->is_paid ?? false,
            'price' => $request->price,
            'valid_till' => $request->valid_till,
            'config' => $request->config
        ]);

        // Log installation
        Installation::create([
            'tenant_id' => $tenantId,
            'module_id' => $module->id,
            'module_key' => $module->module_key,
            'status' => 'installed',
            'step' => 'module_setup',
            'progress' => 100,
            'started_at' => now(),
            'finished_at' => now(),
            'modules' => json_encode([$module->module_key]),
        ]);

        return response()->json($module, 201);
    }

    public function deactivate($tenantId, $moduleId)
    {
        $module = TenantModule::where('tenant_id', $tenantId)->findOrFail($moduleId);
        $module->deactivated_at = now();
        $module->save();
        return response()->json(['message' => 'Module deactivated']);
    }
}