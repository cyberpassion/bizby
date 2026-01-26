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
        $userTenants = TenantUser::where('user_id', $request->user()->id)->get();
		return response()->json([
            'status'  => 'success',
            'message' => 'Tenants Found',
			'data'		=> $userTenants
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

}
