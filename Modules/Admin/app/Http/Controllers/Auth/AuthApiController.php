<?php
namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use Modules\Admin\Models\Tenants\TenantUser;
use Illuminate\Support\Facades\Cache;
use Modules\Admin\Models\Tenants\TenantAccount;

use Illuminate\Support\Facades\DB;

use Modules\Shared\Models\Permissions\PermissionUserRole;

use Modules\Admin\Services\UserProvisionService;

class AuthApiController extends Controller
{
    /* ---------------------------
     | LOGIN
     |---------------------------*/
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        $token = $user->createToken('admin-api')->plainTextToken;

		// 🔥 GET ALL PERMISSIONS
	    $permissions = $user->permissions
    	    ->pluck('slug')
        	->values();

        return response()->json([
            'status' 	=> 'success',
			'message'	=> 'Authentical Successful',
            'token'  	=> $token,
            'data'		=> [
            	'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
				'token'	=> $token,
				'permissions' => $permissions
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
	        'status'  => 'success',
    	    'message' => 'Tenants Found',
        	'data'    => $userTenants
	    ]);
    }

    /* ---------------------------
     | LOGOUT
     |---------------------------*/
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => 'success',
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
    	if (!$tenant) {
        	return response()->json([
            	'step' => 'tenant_select',
            	'redirect' => '/auth/login/tenant-selector'
	        ]);
    	}

	    $tenantAccountInfo = TenantAccount::find($tenant->id);

	    // 2️⃣ Tenant-level TFA
    	$verified = Cache::get("tfa_verified:{$user->id}:{$tenant->id}");
	    Cache::forget("tfa_verified:{$user->id}:{$tenant->id}");

	    if ($tenantAccountInfo->tfa_enabled && ! $verified) {
    	    return response()->json([
        	    'step' => 'tenant_tfa'
        	]);
    	}

	    // 3️⃣ Resolve permissions
    	// $permissions = $user->getPermissions($tenant->id);
		$permissions = auth()->user()?->permissions->pluck('slug');

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

	    if (!$redirect) {
    	    return response()->json([
        	    'step' => 'no_access'
	        ], 403);
    	}

	    // 5️⃣ Final response
    	return response()->json([
        	'step' => 'done',
        	'redirect' => $redirect
	    ]);
	}

	public function register(Request $request)
	{
    	$tenantId = $request->tenant_id; // app('resolvedTenant');

		$tenant = TenantAccount::find($tenantId);

	    if (!$tenant) {
    	    return response()->json([
        	    'status' => 'error',
            	'message' => 'Tenant not resolved'
	        ], 422);
    	}

	    $data = $request->validate([
    	    'name' => 'required|string',
        	'email' => 'required|email|unique:users,email',
    	    'password' => 'required|confirmed|min:6',
    	]);

	    $service = app(UserProvisionService::class);

	    // 🔥 1. Create portal user
    	$user = $service->registerPortalUser($data);

	    // 🔥 2. Get default role (IMPORTANT)
    	$roleId = $this->getDefaultPortalRole($tenant);

	    // 🔥 3. Attach to tenant
    	$tenantUser = $service->createTenantUser(
        	$user,
        	$tenant->id,
        	$roleId
    	);

	    return response()->json([
    	    'status' => 'success',
			'message' => 'Registration Done Successfully',
        	'data'   => [
            	'user' => $user,
            	'tenant_user' => $tenantUser
        	]
	    ], 201);
	}

	protected function getDefaultPortalRole($tenant)
	{
    	$role = DB::table('permission_roles')
	        ->where('tenant_id', $tenant->id)
    	    ->where('slug', 'portal_user') // 🔥 define this
        	->first();

	    if (!$role) {
    	    abort(500, 'Default portal role not configured');
    	}

	    return $role->id;
	}

}
