<?php

namespace Modules\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permission_permissions';

    protected $fillable = [
        'module',
        'operation',
        'slug',
    ];

    /**
     * Roles that have this permission
     */
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
