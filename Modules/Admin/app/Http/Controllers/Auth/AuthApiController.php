<?php

namespace Modules\Admin\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Admin\Models\Tenants\TenantUser;
use Modules\Admin\Services\UserProvisionService;
use Modules\Shared\Services\Permissions\PermissionService;

class AuthApiController extends Controller
{
    /* ---------------------------
     | LOGIN
     |---------------------------*/
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        $token = $user->createToken('admin-api')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Authentical Successful',
            'token' => $token,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token,
            ],
        ]);
    }

    /* ---------------------------
     | CURRENT USER
     |---------------------------*/
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }

    /* ---------------------------
     | USER TENANTS
     |---------------------------*/
    public function tenants(Request $request)
    {
        $userTenants = TenantUser::with(['tenant', 'role'])
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Tenants Found',
            'data' => $userTenants,
        ]);
    }

    /* ---------------------------
     | LOGOUT
     |---------------------------*/
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out',
        ]);
    }

    /* ---------------------------
     | LOGOUT
     |---------------------------*/
    public function loginFlow(Request $request)
    {
        $tenant = app('resolvedTenant');
        $user = $request->user();

        // 1️⃣ No tenant selected
        if (! $tenant) {
            return response()->json([
                'step' => 'tenant_select',
                'redirect' => '/auth/login/tenant-selector',
            ]);
        }

        $tenantAccountInfo = TenantAccount::find($tenant->id);

        // 2️⃣ Tenant-level TFA
        $verified = Cache::get("tfa_verified:{$user->id}:{$tenant->id}");
        Cache::forget("tfa_verified:{$user->id}:{$tenant->id}");

        if ($tenantAccountInfo->tfa_enabled && ! $verified) {
            return response()->json([
                'step' => 'tenant_tfa',
            ]);
        }

        // 3️⃣ Resolve permissions
        $permissions = app(PermissionService::class)->getTenantPermissions($user, $tenant->id)->pluck('slug');

        // (optional but recommended)
        /*session([
            'permissions' => $permissions
        ]);*/

        // 4️⃣ Decide redirect
        $redirect = null;

        if ($permissions->contains('access.admin')) {
            $redirect = '/module/dashboard';
        } elseif ($permissions->contains('access.portal')) {
            $redirect = '/portal/dashboard';
        }

        if (! $redirect) {
            return response()->json([
                'step' => 'no_access',
            ]);
        }

        // 5️⃣ Final response
        return response()->json([
            'step' => 'done',
            'redirect' => $redirect,
        ]);
    }

    public function portalRegister(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATE REQUEST
        |--------------------------------------------------------------------------
        */
        $data = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | TENANT
            |--------------------------------------------------------------------------
            */
            'tenant_id' => [
                'required',
                'integer',
                'exists:tenant_accounts,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | CONTEXT
            |--------------------------------------------------------------------------
            */
            'context' => [
                'required',
                'string',
                'in:registration,listing,hostel',
            ],

            /*
            |--------------------------------------------------------------------------
            | USER
            |--------------------------------------------------------------------------
            */
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:6',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | TENANT
        |--------------------------------------------------------------------------
        */
        $tenant = TenantAccount::find($data['tenant_id']);

        if (! $tenant) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tenant not resolved',
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | USER SERVICE
        |--------------------------------------------------------------------------
        */
        $service = app(UserProvisionService::class);

        /*
        |--------------------------------------------------------------------------
        | CREATE USER
        |--------------------------------------------------------------------------
        */
        $user = $service->registerPortalUser($data);

        /*
        |--------------------------------------------------------------------------
        | BASE PORTAL ROLE
        |--------------------------------------------------------------------------
        */
        /*$basePortalRoleId = DB::table('permission_roles')
            ->where('slug', 'portal_user')
            ->value('id');*/

        /*
        |--------------------------------------------------------------------------
        | MODULE ROLE
        |--------------------------------------------------------------------------
        */
        $moduleRoleId = $this->getDefaultPortalRole(
            $tenant,
            $data['context']
        );

        /*
        |--------------------------------------------------------------------------
        | ATTACH BASE ROLE
        |--------------------------------------------------------------------------
        */
        /*$service->createTenantUser(
            $user,
            $tenant->id,
            $basePortalRoleId
        );*/

        /*
        |--------------------------------------------------------------------------
        | ATTACH MODULE ROLE
        |--------------------------------------------------------------------------
        */
        $tenantUser = $service->createTenantUser(
            $user,
            $tenant->id,
            $moduleRoleId
        );

        /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */
        return response()->json([
            'status' => 'success',

            'message' => 'Registration Done Successfully',

            'data' => [
                'user' => $user,
                'tenant_user' => $tenantUser,
            ],
        ], 201);
    }

    protected function getDefaultPortalRole(
        $tenant,
        string $context
    ) {
        $portalRoleSlug =
            "portal_{$context}_user";

        $role = DB::table('permission_roles')
            ->where('slug', $portalRoleSlug)
            ->first();

        if (! $role) {
            abort(
                500,
                "Default portal role not configured for context: {$context}"
            );
        }

        return $role->id;
    }
}
