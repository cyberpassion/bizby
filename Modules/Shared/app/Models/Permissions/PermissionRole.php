<?php

namespace Modules\Shared\Models\Permissions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionRole extends Model
{
    use HasFactory;

    protected $table = 'permission_roles';
	protected $connection = 'central';

    protected $fillable = [
        'name',
        'tenant_id',
        'guard',
    ];

    /**
     * Relationship: Users (many-to-many via pivot)
     */
    public function users()
    {
        /*return $this->belongsToMany(
            User::class,
            'permission_user_roles',
            'role_id',
            'user_id'
        );*/
    }

    /**
     * Optional: Tenant relationship (if you have Tenant model)
     */
    public function tenant()
    {
        //return $this->belongsTo(Tenant::class);
    }
}