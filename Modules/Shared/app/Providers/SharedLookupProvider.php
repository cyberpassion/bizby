<?php

namespace Modules\Shared\Providers;

use Modules\Shared\Services\LookupRegistry;
use Modules\Shared\Models\Term;
use Modules\Employee\Models\Employee;
use Modules\Student\Models\Student;
use Illuminate\Support\Str;
use Modules\Booking\Models\BookableUnit;
use Modules\Booking\Models\BookingVenue;

class SharedLookupProvider
{
    public function register()
    {
        LookupRegistry::registerFallback(
            fn (string $key) => $this->resolve($key)
        );
    }

    /**
     * Global fallback resolver
     */
    protected function resolve(string $key): array
    {
        if (!str_contains($key, '.')) {
            return [];
        }

        [$namespace, $group] = explode('.', $key, 2);

        if (!$namespace || !$group) {
            return [];
        }

        // ---------------------------------
        // 1️⃣ PLURAL namespaces → TABLES
        // ---------------------------------
        if (Str::plural($namespace) === $namespace) {
            return $this->resolveFromTables($namespace, $group);
        }

        // ---------------------------------
        // 2️⃣ SINGULAR namespaces → TERMS
        // ---------------------------------
        return $this->resolveFromTerms($namespace, $group);
    }

    /**
     * Existing TERMS logic (UNCHANGED)
     */
    protected function resolveFromTerms(string $module, string $group): array
    {
        return Term::where('module', $module)
            ->where('group', $group)
            ->orderBy('sort_order')
            ->get()
            ->mapWithKeys(fn ($term) => [
                $term->id => $term->name
            ])
            ->toArray();
    }

    /**
     * NEW: Table-backed lookups (plural only)
     */
    protected function resolveFromTables(string $namespace, string $group): array
    {
        return match ($namespace) {

            'employees' => $this->employees($group),
            'students'  => $this->students($group),
			'bookings'  => $this->bookings($group),

            default => [],
        };
    }

    protected function employees(string $group): array
    {
        return match ($group) {

            'list' => Employee::where('status', true)
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray(),

            'doctors' => Employee::where('role', 'doctor')
                ->where('status', true)
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray(),

            default => [],
        };
    }

    protected function students(string $group): array
    {
        return match ($group) {

            'list' => Student::where('status', true)
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray(),

            default => [],
        };
    }

	protected function bookings(string $group): array
    {
        return match ($group) {

            'venues-list' => BookingVenue::where('status', true)
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray(),

			'units-list' => BookableUnit::where('status', true)
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray(),

            default => [],
        };
    }

	public function getLookups()
    {
        return [
            'shared.modules.flat' => fn() => $this->modules()
        ];
    }

	protected function modules()
    {
        return collect(LookupRegistry::get('shared.modules'))
        ->flatMap(fn ($group) => $group)
        ->toArray();
    }

}
