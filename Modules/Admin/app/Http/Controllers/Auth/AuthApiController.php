<?php
namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use Modules\Admin\Models\Tenants\TenantUser;

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
     | CREATE USER
     |---------------------------*/
	public function createUser(Request $request)
	{
	    $data = $request->validate([
    	    'name'     => 'required|string|max:255',
        	'email'    => 'required|email|unique:users,email',
        	'password' => 'required|string|min:6',
	    ]);

	    $user = User::create([
    	    'name'     => $data['name'],
        	'email'    => $data['email'],
        	'password' => Hash::make($data['password']),
	    ]);

	    return response()->json([
    	    'status' => 'success',
			'message'=>	'User Created',
        	'data'   => $user,
	    ]);
	}

}
