<?php

namespace Modules\Shared\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class PermissionRolePermission extends Model
{
    protected $table = 'permission_role_permissions';

    protected $fillable = [
        'role_id',
        'permission_id',
        'scope',
    ];

    public function role()
    {
        return $this->belongsTo(PermissionRole::class, 'role_id');
    }

    public function permission()
    {
        return $this->belongsTo(PermissionPermission::class, 'permission_id');
    }
}