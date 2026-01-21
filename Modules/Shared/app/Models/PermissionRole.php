<?php

namespace Modules\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionRole extends Model
{
    use HasFactory;

    protected $table = 'permission_roles';

    protected $fillable = [
        'name',
        'tenant_id',
    ];

    /**
     * Permissions assigned to the role
     */
    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'permission_role_permissions',
            'role_id',
            'permission_id'
        );
    }

    /**
     * Check if role has a specific permission
     */
    public function hasPermission(string $slug): bool
	{
    	return $this->permissions()
        	->where('slug', $slug)
        	->exists();
	}

}
