<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class TfaApiController extends Controller
{
    public function sendTenantTfa(Request $request)
    {
        $user = $request->user();
		$tenant = app('resolvedTenant');

        $otp = 123456;//random_int(100000, 999999);

        Cache::put(
            "tfa:{$user->id}:{$tenant->id}",
            Hash::make($otp),
            now()->addMinutes(5)
        );

        // send OTP (mail/sms/whatsapp)
        // Mail::to($user)->send(new TenantOtpMail($otp));

        return response()->json([
			'otp' => $otp,
            'status' => 'sent',
            'expires_in' => 300
        ]);
    }

    public function verifyTenantTfa(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        $user = $request->user();
        $tenant = app('resolvedTenant');

        $key = "tfa:{$user->id}:{$tenant->id}";
        $hashedOtp = Cache::get($key);

        if (! $hashedOtp) {
            return response()->json(['message' => 'OTP expired'], 422);
        }

        if (! Hash::check($request->otp, $hashedOtp)) {
            return response()->json(['message' => 'Invalid OTP'], 422);
        }

        Cache::forget($key);
        Cache::put( "tfa_verified:{$user->id}:{$tenant->id}", true, now()->addMinutes(2) );

        return response()->json([
            'status' => 'verified'
        ]);
    }
}
