<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Modules\Admin\Models\Tenant;

class TenantController extends Controller
{
    public function index()
    {
        return Tenant::all();
    }

    public function show($id)
    {
        return Tenant::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:tenant,code',
            'domain' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'plan' => 'nullable|string',
            'valid_till' => 'nullable|date',
            'is_active' => 'boolean',
            'settings' => 'nullable|json',
        ]);

        $tenant = Tenant::create($data);
        return response()->json($tenant, 201);
    }

    public function update(Request $request, $id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->update($request->all());
        return response()->json($tenant);
    }

    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();
        return response()->json(['message' => 'Tenant deleted']);
    }
}