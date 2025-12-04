<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Modules\Admin\Models\Installation;

class InstallationController extends Controller
{
    public function index($tenantId)
    {
        return Installation::where('tenant_id', $tenantId)->get();
    }

    public function show($id)
    {
        return Installation::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tenant_id' => 'required|integer',
            'module_id' => 'nullable|integer',
            'module_key' => 'nullable|string',
            'app_version' => 'nullable|string',
            'build_number' => 'nullable|string',
            'status' => 'required|string',
            'step' => 'nullable|string',
            'progress' => 'nullable|integer',
            'php_version' => 'nullable|string',
            'server_ip' => 'nullable|string',
            'installed_by' => 'nullable|string',
            'install_type' => 'nullable|string',
            'modules' => 'nullable|json',
            'config' => 'nullable|json',
            'logs' => 'nullable|json',
            'started_at' => 'nullable|date',
            'finished_at' => 'nullable|date'
        ]);

        $installation = Installation::create($data);
        return response()->json($installation, 201);
    }
}