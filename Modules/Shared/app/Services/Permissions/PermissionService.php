<?php

namespace Modules\Shared\Services\Permissions;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Models\Modules\Module;
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

    public function getResolvedTenantModules(int $tenantId): array
    {
        $installed = TenantModule::query()
            ->with('module:id,key,dependencies')
            ->where('tenant_id', $tenantId)
            ->where('is_active', 1)
            ->get();

        $allModules = Module::query()
            ->get(['id', 'key', 'dependencies'])
            ->keyBy('key');

        $resolved = [];

        foreach ($installed as $tenantModule) {

            if (! $tenantModule->module) {
                continue;
            }

            $this->resolveDependencies(
                $tenantModule->module->key,
                $allModules,
                $resolved
            );
        }

        return array_values(array_unique($resolved));
    }

    protected function resolveDependencies(
        string $moduleKey,
        $allModules,
        array &$resolved,
        array &$visiting = []
    ): void {

        if (isset($visiting[$moduleKey])) {
            return;
        }

        if (in_array($moduleKey, $resolved)) {
            return;
        }

        $visiting[$moduleKey] = true;

        $module = $allModules->get($moduleKey);

        if (! $module) {
            return;
        }

        foreach (($module->dependencies ?? []) as $dependency) {
            $this->resolveDependencies(
                $dependency,
                $allModules,
                $resolved,
                $visiting
            );
        }

        $resolved[] = $moduleKey;

        unset($visiting[$moduleKey]);
    }

    public function getPermissionSlugs(
        User $user,
        int $tenantId
    ): array {
        return $this->getTenantPermissions(
            $user,
            $tenantId
        )
            ->pluck('slug')
            ->unique()
            ->values()
            ->toArray();

        return Cache::remember(
            "permissions:{$tenantId}:{$user->id}",
            now()->addHours(12),
            function () use ($user, $tenantId) {

                return $this->getTenantPermissions(
                    $user,
                    $tenantId
                )
                    ->pluck('slug')
                    ->unique()
                    ->values()
                    ->toArray();
            }
        );
    }

    public function getTenantPermissions(
        User $user,
        int $tenantId
    ) {
        $common = ['admin'];
        $modules = $this->getResolvedTenantModules($tenantId);
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

        return in_array(
            $slug,
            $this->getPermissionSlugs($user, $tenantId)
        );
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
