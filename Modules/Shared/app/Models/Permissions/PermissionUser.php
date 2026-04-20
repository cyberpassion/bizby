<?php

namespace Modules\Shared\Models\Permissions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionUser extends Model
{
    use HasFactory;

    protected $table = 'permission_user_roles';

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    /**
     * Relationship: User
     */
    public function user()
    {
        //return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Role
     */
    public function role()
    {
        return $this->belongsTo(PermissionRole::class, 'role_id');
    }
}