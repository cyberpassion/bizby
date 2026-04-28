<?php

namespace Modules\Shared\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class PermissionUserPermission extends Model
{
    protected $table = 'permission_user_permissions';

    protected $fillable = [
        'user_id',
        'permission_id',
        'tenant_id',
        'scope',
    ];

    public function permission()
    {
        return $this->belongsTo(PermissionPermission::class, 'permission_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}