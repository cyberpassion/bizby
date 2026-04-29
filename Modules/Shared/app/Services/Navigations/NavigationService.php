<?php

namespace Modules\Shared\Services\Navigations;

use Illuminate\Support\Facades\Cache;
use Modules\Shared\Services\LookupRegistry;

use Illuminate\Support\Facades\DB;

class NavigationService
{
    /* ================= CONTEXT ================= */

    protected static function context(): array
    {

		//print_r(auth()->id());print_r(tenant()->id);die();
		//print_r(\DB::table('permission_users')->where('user_id', 1)->get());die();
		//print_r(auth()->user()?->roles);die();
		//print_r(['status'=>'success','data'=>auth()->user()?->permissions?->pluck('slug')->toArray()]);die();
        $user   = auth()->user();
        $tenant = tenant();

        return [
            'permissions' => $user?->permissions?->pluck('slug')->toArray() ?? [],
            'modules'     => tenant()->modules()->get() ?? [],
            'addons'      => tenant()->addons()->get() ?? [],
            'role_id'     => $user?->role_id,
            'tenant_id'   => $tenant->id,
        ];
    }

    /* ================= ACCESS CHECK ================= */

    protected static function allowed(array $menu, array $ctx): bool
    {
		// return true; // 🚑 TEMPORARY BYPASS
        // Enable when ready
        if (!empty($menu['permission']) && !in_array($menu['permission'], $ctx['permissions'], true)) {
            return false;
        }

        if (!empty($menu['addon']) && !in_array($menu['addon'], $ctx['addons'], true)) {
            return false;
        }

        if (!empty($menu['module']) && !in_array($menu['module'], $ctx['modules'], true)) {
            return false;
        }

        return true;
    }

    /* ================= RECURSIVE FILTER ================= */

    protected static function filterMenu(array $menus, array $ctx): array
	{
    	$filtered = [];

	    foreach ($menus as $menu) {

	        if (!is_array($menu)) {
    	        continue;
        	}

	        // 🔁 filter children first
    	    if (!empty($menu['items']) && is_array($menu['items'])) {
        	    $menu['items'] = self::filterMenu($menu['items'], $ctx);
        	}

	        $isAllowed   = self::allowed($menu, $ctx);
    	    $hasChildren = !empty($menu['items']);

	        // ❌ remove if not allowed AND no children
    	    if (!$isAllowed && !$hasChildren) {
        	    continue;
        	}

	        // ❌ remove empty groups like Reports, Settings
    	    if (isset($menu['items']) && empty($menu['items'])) {
        	    continue;
        	}

			// ✅ APPLY LABELS HERE
		    $menu = self::applyLabels($menu);

	        $filtered[] = $menu;
    	}

	    return $filtered;
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

	// Menu Labels
	protected static function labels(): array
	{
    	static $labels = null;

	    if ($labels !== null) {
    	    return $labels;
    	}

	    $rows = DB::table('options')
    	    ->where('name', 'like', '%_singular')
        	->orWhere('name', 'like', '%_plural')
	        ->pluck('value', 'name')
    	    ->toArray();

	    $labels = [];

	    foreach ($rows as $key => $value) {
    	    // asset_singular → [asset][singular]
        	if (preg_match('/(.*)_(singular|plural)/', $key, $matches)) {
            	$module = $matches[1];
            	$type   = $matches[2];

	            $labels[$module][$type] = $value;
    	    }
    	}

	    return $labels;
	}

	protected static function applyLabels(array $menu): array
	{
    	$labels = self::labels();

	    $replacements = [];

	    foreach ($labels as $module => $forms) {
    	    $singular = $forms['singular'] ?? ucfirst($module);
        	$plural   = $forms['plural'] ?? $singular . 's';

	        $replacements[ucfirst($module)] = $singular;
    	    $replacements[ucfirst($module) . 's'] = $plural;
    	}

	    foreach (['title', 'description'] as $key) {
    	    if (!empty($menu[$key])) {
        	    $menu["{$key}_custom"] = str_replace(
            	    array_keys($replacements),
                	array_values($replacements),
                	$menu[$key]
	            );
    	    }
    	}

	    return $menu;
	}

}
