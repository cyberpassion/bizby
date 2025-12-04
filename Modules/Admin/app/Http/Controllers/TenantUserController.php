<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Modules\Admin\Models\TenantUser;
use Illuminate\Support\Facades\Hash;

class TenantUserController extends Controller
{
    public function index()
    {
        return TenantUser::all();
    }

    public function show($id)
    {
        return TenantUser::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tenant_id' => 'required|integer',
            'name' => 'required|string',
            'email' => 'required|email|unique:tenant_user,email',
            'phone' => 'nullable|string',
            'password' => 'required|string',
            'role' => 'required|string',
            'is_active' => 'boolean',
            'meta' => 'nullable|json',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = TenantUser::create($data);
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = TenantUser::findOrFail($id);
        if ($request->has('password')) {
            $request->merge(['password' => Hash::make($request->password)]);
        }
        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = TenantUser::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}