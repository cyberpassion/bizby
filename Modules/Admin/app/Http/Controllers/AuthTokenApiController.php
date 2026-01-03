<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Services\AuthTokenService;
use Modules\Shared\Mail\Auth\LoginOtpMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Modules\Admin\Models\AuthToken;

class AuthTokenApiController extends Controller
{
    public function sendLoginOtp(Request $request, AuthTokenService $service)
	{
    	$request->validate([
        	'email' => 'required|email'
    	]);

	    // Always return same response (prevent email enumeration)
    	$user = User::where('email', $request->email)->first();

	    if (! $user) {
    	    return response()->json(['status' => 'otp_sent']);
    	}

	    // ⏳ Cooldown: 1 OTP per minute per user
    	$recentOtp = AuthToken::where('tokenable_id', $user->id)
        	->where('tokenable_type', User::class)
        	->where('type', 'login_otp')
	        ->where('created_at', '>', now()->subMinute())
    	    ->exists();

	    if ($recentOtp) {
    	    return response()->json([
        	    'message' => 'Please wait before requesting another OTP.'
        	], 429);
    	}

	    // ❌ Invalidate previous unused OTPs
    	AuthToken::where('tokenable_id', $user->id)
        	->where('tokenable_type', User::class)
        	->where('type', 'login_otp')
	        ->whereNull('used_at')
    	    ->update(['used_at' => now()]);

	    // ✅ Create new OTP
    	$otp = $service->createOtp($user);

	    // 📧 Send email
    	Mail::to($user->email)->queue(
        	new LoginOtpMail($user->name, $otp)
   		);

	    return response()->json(['status' => 'otp_sent']);
	}

    public function verifyLoginOtp(Request $request, AuthTokenService $service)
    {
        $user = User::where('email', $request->email)->firstOrFail();

        $valid = $service->verifyOtp($user, $request->otp);

        if (! $valid) {
            return response()->json(['message' => 'Invalid OTP'], 422);
        }

        return response()->json(['status' => 'verified']);
    }
}
