<?php

namespace Modules\Admin\Models\Tenants;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class TenantUser extends Authenticatable
{
    use HasApiTokens, Notifiable; // <-- Add HasApiTokens here

    protected $table = 'tenant_users';
	protected $connection = 'central';

    protected $fillable = [
        'user_id', 'name', 'email', 'password', 'tenant_id', 'role_id'
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
