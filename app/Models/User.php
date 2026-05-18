<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Shared\Models\Permissions\PermissionPermission;
use Modules\Shared\Models\Permissions\PermissionRole;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $connection = 'central';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    public function tenants()
    {
        return $this->belongsToMany(
            TenantAccount::class,
            'tenant_users',
            'user_id',
            'tenant_id'
        );
    }

    public function roles()
    {
        return $this->belongsToMany(
            PermissionRole::class,
            'permission_user_roles',
            'user_id',
            'role_id'
        );
    }

    public function directPermissions()
    {
        return $this->belongsToMany(
            PermissionPermission::class,
            'permission_user_permissions',
            'user_id',
            'permission_id'
        );
    }
}
