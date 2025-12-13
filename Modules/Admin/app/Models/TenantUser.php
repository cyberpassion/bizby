<?php

namespace Modules\Admin\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class TenantUser extends Authenticatable
{
    use HasApiTokens, Notifiable; // <-- Add HasApiTokens here

    protected $table = 'tenant_users';

    protected $fillable = [
        'name', 'email', 'password', 'tenant_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	public function setPasswordAttribute($value)
	{
    	if (!empty($value)) {
        	$this->attributes['password'] = \Illuminate\Support\Facades\Hash::make($value);
    	}
	}

}
