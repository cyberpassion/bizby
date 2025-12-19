<?php

namespace Modules\Shared\Providers;

use Modules\Shared\Services\LookupRegistry;
use Modules\Shared\Models\Term;

class SharedLookupProvider
{
    public function register()
    {
        LookupRegistry::registerFallback(
            fn (string $key) => $this->resolveFromTerms($key)
        );
    }

    protected function resolveFromTerms(string $key): array
    {
        // Expecting: module.group
        if (!str_contains($key, '.')) {
            return [];
        }

        [$module, $group] = explode('.', $key, 2);

        // Safety: avoid accidental global queries
        if (!$module || !$group) {
            return [];
        }

        return Term::where('module', $module)
            ->where('group', $group)
            ->orderBy('sort_order')
            ->get()
            ->mapWithKeys(fn ($term) => [
                $term->id => $term->name
            ])
            ->toArray();
    }
}
