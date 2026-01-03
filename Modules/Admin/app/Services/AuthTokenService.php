<?php

namespace Modules\Admin\Services;

use Illuminate\Support\Str;
use Modules\Admin\Models\AuthToken;

class AuthTokenService
{
    /* -----------------------------
     | Create OTP
     |-----------------------------*/
    public function createOtp($user, string $type = 'login_otp', int $minutes = 5): string
    {
        $otp = (string) random_int(100000, 999999);

        AuthToken::create([
            'tokenable_id'   => $user->id,
            'tokenable_type' => get_class($user),
            'type'           => $type,
            'token'          => hash('sha256', $otp),
            'expires_at'     => now()->addMinutes($minutes),
        ]);

        return $otp; // raw OTP ONLY for email
    }

    /* -----------------------------
     | Verify OTP
     |-----------------------------*/
    public function verifyOtp($user, string $otp, string $type = 'login_otp'): bool
	{
    	$record = AuthToken::where('tokenable_id', $user->id)
	        ->where('tokenable_type', get_class($user))
    	    ->where('type', $type)
        	->valid()
	        ->latest()
    	    ->first();

	    if (! $record) {
    	    return false;
    	}

	    // ❌ Too many attempts
    	if ($record->attempts >= 5) {
        	$record->update(['used_at' => now()]); // invalidate
        	return false;
	    }

	    // ❌ Wrong OTP
    	if (! hash_equals($record->token, hash('sha256', $otp))) {
        	$record->increment('attempts');
        	return false;
    	}

	    // ✅ Correct OTP
    	$record->update(['used_at' => now()]);
    	return true;
	}

    /* -----------------------------
     | Create Link Token
     |-----------------------------*/
    public function createLinkToken($user, string $type, int $minutes = 60): string
    {
        $raw = Str::random(64);

        AuthToken::create([
            'tokenable_id'   => $user->id,
            'tokenable_type' => get_class($user),
            'type'           => $type,
            'token'          => hash('sha256', $raw),
            'expires_at'     => now()->addMinutes($minutes),
        ]);

        return $raw;
    }

    /* -----------------------------
     | Verify Link Token
     |-----------------------------*/
    public function verifyLinkToken(string $raw, string $type): ?AuthToken
    {
        $record = AuthToken::where('type', $type)
            ->valid()
            ->get()
            ->first(fn ($t) => hash_equals($t->token, hash('sha256', $raw)));

        if (! $record) {
            return null;
        }

        $record->update(['used_at' => now()]);
        return $record;
    }
}
