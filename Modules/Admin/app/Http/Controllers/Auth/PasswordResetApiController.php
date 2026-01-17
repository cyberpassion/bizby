<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PasswordResetApiController extends Controller
{
    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink($request->only('email'));

        return response()->json([
            'status'  => $status === Password::RESET_LINK_SENT ? 'success' : 'error',
            'message' => __($status),
        ]);
    }

	public function verify(Request $request)
	{
	    $request->validate([
    	    'email' => 'required|email',
        	'token' => 'required|string',
	    ]);

	    $record = DB::table('password_reset_tokens')
    	    ->where('email', $request->email)
        	->first();

	    if (! $record) {
    	    return response()->json([
        	    'status' => 'error',
            	'message' => 'Invalid or expired token',
	        ], 400);
    	}

	    // Laravel stores hashed token
    	if (! Hash::check($request->token, $record->token)) {
        	return response()->json([
            	'status' => 'error',
            	'message' => 'Invalid token',
	        ], 400);
    	}

	    return response()->json([
    	    'status' => 'success',
        	'message' => 'Token verified successfully',
	    ]);
	}

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return response()->json([
            'status'  => $status === Password::PASSWORD_RESET ? 'success' : 'error',
            'message' => __($status),
        ]);
    }
}
