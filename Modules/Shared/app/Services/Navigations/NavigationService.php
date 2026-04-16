<?php

namespace Modules\Shared\Services\Navigations;

use Illuminate\Support\Facades\Cache;
use Modules\Shared\Services\LookupRegistry;

class NavigationService
{
    /* ================= CONTEXT ================= */

    protected static function context(): array
    {
        $user   = auth()->user();
        $tenant = tenant();

        return [
            'permissions' => $user?->permissions?->pluck('key')->toArray() ?? [],
            'modules'     => tenant()->purchased_modules ?? [],
            'addons'      => tenant()->purchased_addons ?? [],
            'role_id'     => $user?->role_id,
            'tenant_id'   => $tenant->id,
        ];
    }

    /* ================= ACCESS CHECK ================= */

    protected static function allowed(array $menu, array $ctx): bool
    {
        // Enable when ready
        /*
        if (!empty($menu['permission']) && !in_array($menu['permission'], $ctx['permissions'], true)) {
            return false;
        }

        if (!empty($menu['addon']) && !in_array($menu['addon'], $ctx['addons'], true)) {
            return false;
        }

        if (!empty($menu['module']) && !in_array($menu['module'], $ctx['modules'], true)) {
            return false;
        }
        */

        return true;
    }

    /* ================= RECURSIVE FILTER ================= */

    protected static function filterMenu(array $menus, array $ctx): array
    {
        $filtered = [];

        foreach ($menus as $menu) {

			// 🚑 HARD GUARD
	        if (!is_array($menu)) {
    	        continue;
        	}

            // Filter children first
            if (!empty($menu['items']) && is_array($menu['items'])) {
                $menu['items'] = self::filterMenu($menu['items'], $ctx);
            }

            // Keep if allowed or has visible children
            if (self::allowed($menu, $ctx) || !empty($menu['items'])) {
                $filtered[] = $menu;
            }
        }

        return array_values($filtered);
    }

    /* ================= SIDEBAR ================= */

    public static function sidebar(): array
    {
        $ctx = self::context();

        // Enable caching when stable
        /*
        $cacheKey = "nav.sidebar.{$ctx['tenant_id']}.{$ctx['role_id']}";

        return Cache::remember($cacheKey, 3600, function () use ($ctx) {
            return self::buildSidebar($ctx);
        });
        */

        return self::buildSidebar($ctx);
    }

    protected static function buildSidebar(array $ctx): array
    {
        $menus = LookupRegistry::get('.ui.sidebar-menu');

        if (!is_array($menus)) {
	        return [];
    	}

	    return self::filterMenu(
    	    collect($menus)
        	    ->sortBy('order')
            	->values()
            	->toArray(),
	        $ctx
    	);
    }

    /* ================= HEADER ================= */

    public static function header(): array
    {
        $ctx = self::context();

        return self::filterMenu(
            collect(
                LookupRegistry::getBySuffix('.ui.header-menu')
            )
                ->unique('slug')
                ->sortBy('order')
                ->values()
                ->toArray(),
            $ctx
        );
    }

    /* ================= MODULE ================= */

    public static function module(string $module): array
    {
        $ctx = self::context();
        $key = strtolower($module) . '.ui.sidebar-menu';

        return self::filterMenu(
            LookupRegistry::get($key) ?? [],
            $ctx
        );
    }

    /* ================= ITEM ================= */

	public static function item(string $module, string $action, string|int|null $id = null): array
	{
	    $ctx = self::context();
    	$key = strtolower($module) . ".ui.single-actions.{$action}";

	    return collect(
    	    self::filterMenu(LookupRegistry::get($key) ?? [], $ctx)
    	)->map(function ($menu) use ($id) {

	        // Replace {id} only when ID is provided
    	    if ($id !== null && isset($menu['href'])) {
        	    $menu['href'] = str_replace('{id}', $id, $menu['href']);
        	}

	        return $menu;
    	})
	    ->values()
    	->toArray();
	}

}
