<?php

namespace Modules\Shared\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_roles';
	protected $connection = 'central';

    protected $fillable = [
        'name',
        'tenant_id',
        'guard',
    ];

    // 🔹 Permissions assigned to role
    public function permissions()
    {//echo 'x';die();
        return $this->belongsToMany(
            PermissionPermission::class,
            'permission_role_permissions',
            'role_id',
            'permission_id'
        );
    }

    // 🔹 Users having this role
    public function users()
    {
        return $this->belongsToMany(
            \App\Models\User::class,
            'permission_user_roles',
            'role_id',
            'user_id'
        );
    }
}