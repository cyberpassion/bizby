<?php

namespace Modules\Shared\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class PermissionPermission extends Model
{
    protected $table = 'permission_permissions';

    protected $fillable = [
        'module',
        'operation',
        'slug',
        'scope',
        'guard',
        'parent_id',
    ];

    // 🔹 Parent permission (hierarchy)
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    // 🔹 Child permissions
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    // 🔹 Roles having this permission
    public function roles()
    {
        return $this->belongsToMany(
            PermissionRole::class,
            'permission_role_permissions',
            'permission_id',
            'role_id'
        );
    }
}