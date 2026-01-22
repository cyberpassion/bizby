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
        $permissions = self::getCached($userId, $tenantId);

        if (!isset($permissions[$slug])) {
            return false;
        }

        if ($scope === null) {
            return true;
        }

        return in_array($scope, $permissions[$slug]);
    }

    protected static function getCached(int $userId, int $tenantId): array
    {
        return Cache::remember(
            "permissions:$tenantId:$userId",
            3600,
            function () use ($userId, $tenantId) {

                $rolePermissions = DB::table('permission_roles as r')
                    ->join('permission_role_permissions as rp', 'rp.role_id', '=', 'r.id')
                    ->join('permission_permissions as p', 'p.id', '=', 'rp.permission_id')
                    ->where('r.tenant_id', $tenantId)
                    ->whereIn('r.id', function ($q) use ($userId) {
                        $q->select('role_id')
                          ->from('permission_user_roles')
                          ->where('user_id', $userId);
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
        );
    }
}
