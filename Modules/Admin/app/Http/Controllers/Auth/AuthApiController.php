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

        return response()->json([
            'status' 	=> 'success',
			'message'	=> 'Authentical Successful',
            'token'  	=> $token,
            'data'		=> [
            	'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
				'token'	=> $token
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

    	$tenant = app('resolvedTenant'); // from middleware
		$user = $request->user()->id;

	    // 1️⃣ No tenant selected
    	if (!$tenant) {
        	return response()->json([
            	'step' => 'tenant_select',
				'redirect' => '/auth/login/tenant-selector'
	        ]);
    	}

		$tenantAccountInfo = TenantAccount::find($tenant->id);

	    // 2️⃣ Tenant-level TFA (and not verified yet)
		$verified = Cache::get("tfa_verified:{$user}:{$tenant->id}");
		Cache::forget("tfa_verified:{$user}:{$tenant->id}");

		if ($tenantAccountInfo->tfa_enabled && ! $verified) {
		    return response()->json([
        		'step' => 'tenant_tfa'
		    ]);
		}

	    // 3️⃣ All good → dashboard
    	return response()->json([
        	'step' => 'done',
        	'redirect' => '/module/dashboard'
	    ]);
	}

	public function register(Request $request)
	{
    	$tenant = app('resolvedTenant');

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
        	'data'   => [
            	'user' => $user,
				'message' => 'Registration Done Successfully',
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
