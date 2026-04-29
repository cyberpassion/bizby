<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;
	use HasApiTokens, Notifiable;

	protected $connection = 'central';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

	public function roles()
	{
    	return $this->belongsToMany(
	        \Modules\Shared\Models\Permissions\PermissionRole::class,
    	    'permission_user_roles',
        	'user_id',
        	'role_id'
	    );
	}

	public function directPermissions()
	{
    	return $this->belongsToMany(
	        \Modules\Shared\Models\Permissions\PermissionPermission::class,
    	    'permission_user_permissions',
        	'user_id',
        	'permission_id'
	    );
	}

	public function getPermissionsAttribute()
	{
		//print_r( $this->roles()->pluck('slug'));die();
    	$direct = $this->directPermissions ?? collect();

	    $rolePermissions = $this->roles()
    	    ->with('permissions')
        	->get()
	        ->pluck('permissions')
    	    ->flatten();

	    return $direct
    	    ->merge($rolePermissions)
        	->unique('id')
        	->values();
	}

}
