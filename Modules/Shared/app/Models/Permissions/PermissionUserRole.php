<?php

namespace Modules\Shared\Models\Permissions;

use Illuminate\Database\Eloquent\Model;

class PermissionUserRole extends Model
{
    protected $table = 'permission_user_roles';

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(PermissionRole::class, 'role_id');
    }
}