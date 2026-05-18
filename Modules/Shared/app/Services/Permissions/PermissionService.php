<?php

namespace Modules\Shared\Services\Permissions;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Models\Tenants\TenantModule;

class PermissionService
{
    public function getAllPermissions(User $user)
    {
        $direct = $user->directPermissions()->get();

        $rolePermissions = $user->roles()
            ->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten();

        return $direct
            ->merge($rolePermissions)
            ->unique('id')
            ->values();
    }

    public function getTenantModules(int $tenantId): array
    {
        return TenantModule::query()
            ->where('tenant_id', $tenantId)
            ->where('is_active', 1)
            ->pluck('module_key')
            ->toArray();
    }

    public function getTenantPermissions(
        User $user,
        int $tenantId
    ) {
        $common = ['admin'];
        $modules = $this->getTenantModules($tenantId);
        $addons = []; // later
        $features = []; // later

        $resources = array_unique(
            array_merge(
                $common,
                $modules,
                $addons,
                $features
            )
        );

        return $this->getAllPermissions($user)
            ->filter(function ($permission) use ($resources) {

                // global permissions
                if (! $permission->resource) {
                    return true;
                }

                return in_array(
                    $permission->resource,
                    $resources
                );
            })
            ->values();
    }

    public function hasPermission(
        User $user,
        int $tenantId,
        string $slug
    ): bool {

        return $this->getTenantPermissions(
            $user,
            $tenantId
        )
            ->pluck('slug')
            ->contains($slug);
    }

    public function assignDirectPermissions(
        int $userId,
        int $tenantId,
        array $permissionIds
    ): void {

        foreach ($permissionIds as $pid) {

            DB::table('permission_user_permissions')
                ->updateOrInsert(
                    [
                        'user_id' => $userId,

                        'permission_id' => $pid,

                        'tenant_id' => $tenantId,
                    ],
                    [
                        'created_at' => now(),

                        'updated_at' => now(),
                    ]
                );
        }

        Cache::forget(
            'permissions:'.$tenantId.':'.$userId
        );
    }

    public function revokeDirectPermissions(
        int $userId,
        int $tenantId,
        array $permissionIds
    ): void {

        DB::table('permission_user_permissions')
            ->where('user_id', $userId)
            ->where('tenant_id', $tenantId)
            ->whereIn('permission_id', $permissionIds)
            ->delete();

        Cache::forget(
            'permissions:'.$tenantId.':'.$userId
        );
    }
}
