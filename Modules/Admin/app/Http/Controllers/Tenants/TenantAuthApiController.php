<?php

namespace Modules\Admin\Http\Controllers\Tenants;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;

class TenantAuthApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('tenant')->attempt($credentials)) {
            $user = Auth::guard('tenant')->user();
            $token = $user->createToken('tenant-token')->plainTextToken; // <-- works only if HasApiTokens is used

			return response()->json([
	            'status' => 'success',
    	        'message' => 'Authentication Successful.',
        	    'data' => $user,
				'token'=> $token
        	], Response::HTTP_CREATED);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
