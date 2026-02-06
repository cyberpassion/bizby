<?php

namespace Modules\Shared\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Permissions
{
    public static function can(
        int $userId,
        int $tenantId,
        string $slug,
        ?string $scope = null
    ): bool {
        $permissions = self::resolvePermissions($userId, $tenantId);
		//echo $slug;
		//print_r($permissions);

        if (!isset($permissions[$slug])) {
            return false;
        }

        // No scope check → permission exists
        if ($scope === null) {
            return true;
        }

        // Global permission overrides scope
        if (in_array('global', $permissions[$slug], true)) {
            return true;
        }

        return in_array($scope, $permissions[$slug], true);
    }

    /**
     * Decide whether to use cache or direct DB
     */
    protected static function resolvePermissions(int $userId, int $tenantId): array
    {
        if (app()->environment('local', 'testing')) {
            return self::loadPermissions($userId, $tenantId);
        }

        return self::getCached($userId, $tenantId);
    }

    /**
     * Cached permissions (production)
     */
    protected static function getCached(int $userId, int $tenantId): array
    {
        return Cache::remember(
            "permissions:$tenantId:$userId",
            3600,
            fn () => self::loadPermissions($userId, $tenantId)
        );
    }

    /**
     * Raw DB permission loader (development / debugging)
     */
    public static function loadPermissions(int $userId, int $tenantId): array
    {
        $rolePermissions = DB::table('permission_roles as r')
            ->join('permission_role_permissions as rp', 'rp.role_id', '=', 'r.id')
            ->join('permission_permissions as p', 'p.id', '=', 'rp.permission_id')
            ->where('r.tenant_id', $tenantId)
            ->whereIn('r.id', function ($q) use ($userId, $tenantId) {
                $q->select('role_id')
                  ->from('permission_user_roles')
                  ->where('user_id', $userId)
                  ->where('tenant_id', $tenantId);
            })
            ->select('p.slug', 'rp.scope')
            ->get();

        $userPermissions = DB::table('permission_user_permissions as up')
            ->join('permission_permissions as p', 'p.id', '=', 'up.permission_id')
            ->where('up.user_id', $userId)
            ->where('up.tenant_id', $tenantId)
            ->select('p.slug', 'up.scope')
            ->get();

        $final = [];

        foreach ($rolePermissions->merge($userPermissions) as $row) {
            $final[$row->slug][] = $row->scope ?? 'global';
        }

        return $final;
    }

    /**
     * Clear cache when roles/permissions change
     */
    public static function forget(int $userId, int $tenantId): void
    {
        Cache::forget("permissions:$tenantId:$userId");
    }
}
