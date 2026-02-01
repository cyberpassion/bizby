<?php

namespace Modules\Shared\Services\Navigations;

use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Cache;

class NavigationService
{
    /* ================= CONTEXT ================= */
    protected static function context(): array
    {
        $user = auth()->user();

        return [
            'permissions' => $user->permissions->pluck('key')->toArray(),
            'modules'     => tenant()->purchased_modules ?? [],
            'addons'      => tenant()->purchased_addons ?? [],
            'role_id'     => $user->role_id,
            'tenant_id'   => tenant()->id,
        ];
    }

    /* ================= PERMISSION CHECK ================= */
    protected static function allowed(array $menu, array $ctx): bool
    {
        if (isset($menu['permission']) && !in_array($menu['permission'], $ctx['permissions'])) {
            return false;
        }

        if (isset($menu['addon']) && !in_array($menu['addon'], $ctx['addons'])) {
            return false;
        }

        return true;
    }

    /* ================= SIDEBAR ================= */
    public static function sidebar(): array
    {
        $ctx = self::context();

        $cacheKey = "nav_sidebar_{$ctx['tenant_id']}_{$ctx['role_id']}";

        return Cache::remember($cacheKey, 3600, function () use ($ctx) {

            $menus = [];

            foreach (Module::allEnabled() as $module) {

                $moduleName = strtolower($module->getName());

                if (!in_array($moduleName, $ctx['modules'])) {
                    continue;
                }

                $path = $module->getPath() . '/Config/navigation.php';
                if (!file_exists($path)) continue;

                $config = require $path;

                foreach ($config['sidebar'] ?? [] as $menu) {
                    if (self::allowed($menu, $ctx)) {
                        $menus[] = $menu;
                    }
                }
            }

            return $menus;
        });
    }

    /* ================= HEADER ================= */
    public static function header(): array
    {
        $ctx = self::context();
        $menus = [];

        foreach (Module::allEnabled() as $module) {

            $path = $module->getPath() . '/Config/navigation.php';
            if (!file_exists($path)) continue;

            $config = require $path;

            foreach ($config['header'] ?? [] as $menu) {
                if (self::allowed($menu, $ctx)) {
                    $menus[] = $menu;
                }
            }
        }

        return $menus;
    }

    /* ================= MODULE ================= */
    public static function module(string $moduleName): array
    {
        $ctx = self::context();

        $module = Module::find($moduleName);
        if (!$module) return [];

        $path = $module->getPath() . '/Config/navigation.php';
        if (!file_exists($path)) return [];

        $config = require $path;

        return collect($config['module'] ?? [])
            ->filter(fn($m) => self::allowed($m, $ctx))
            ->values()
            ->toArray();
    }

    /* ================= ITEM ================= */
    public static function item(string $moduleName, int $id): array
    {
        $ctx = self::context();

        $module = Module::find($moduleName);
        if (!$module) return [];

        $path = $module->getPath() . '/Config/navigation.php';
        if (!file_exists($path)) return [];

        $config = require $path;

        $menus = $config['item'][$moduleName] ?? [];

        $result = [];

        foreach ($menus as $menu) {
            if (self::allowed($menu, $ctx)) {
                $menu['href'] = str_replace('{id}', $id, $menu['href']);
                $result[] = $menu;
            }
        }

        return $result;
    }
}
