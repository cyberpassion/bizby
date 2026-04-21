<?php

namespace Modules\Shared\Providers;

use Modules\Shared\Services\LookupRegistry;
use Modules\Shared\Models\Term;
use Illuminate\Support\Str;

use Modules\Asset\Models\Asset;

use Modules\Attendance\Models\AttendanceBatch;
use Modules\Employee\Models\Employee;
use Modules\Student\Models\Student;

use Modules\Center\Models\Center;
use Modules\Consultation\Models\Consultation;

use Modules\Vendor\Models\Vendor;
use Modules\Product\Models\Product;

use Modules\Inventory\Models\InventoryItem;

use Modules\Lead\Models\Lead;
use Modules\Booking\Models\BookableUnit;
use Modules\Booking\Models\BookingVenue;

use Modules\Shared\Models\Permissions\PermissionRole;

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
	    // Tenant terms (already scoped via TenantModel)
    	$tenantTerms = Term::query()
	        ->where('module', $module)
    	    ->where('group', $group)
        	->orderBy('sort_order')
        	->get();

	    // Core terms (force connection)
    	$coreTerms = Term::on('central')
    	    ->where('module', $module)
	        ->where('group', $group)
        	->orderBy('sort_order')
        	->get();

	    // Merge (tenant overrides core if same name)
    	$merged = $tenantTerms
        	->keyBy('name')
        	->merge($coreTerms->keyBy('name'));

	    // Return safe IDs (NO clash)
    	return $merged->mapWithKeys(function ($term) {
        	$prefix = $term->getConnectionName() === 'central' ? 'core_' : 'tenant_';

	        return [
    	        $prefix . $term->id => $term->name
        	];
	    })->toArray();
	}

    /**
     * NEW: Table-backed lookups (plural only)
     */
    protected function resolveFromTables(string $namespace, string $group): array
    {
        return match ($namespace) {

			'assets'		=> $this->assets($group),
			'attendances'	=> $this->attendances($group),
            'employees'		=> $this->employees($group),
            'students'		=> $this->students($group),
			'centers'		=> $this->centers($group),
			'consultations' => $this->consultations($group),
			'leads'			=> $this->leads($group),
			'bookings'		=> $this->bookings($group),
			'vendors'		=> $this->vendors($group),
			'products'		=> $this->products($group),
			'inventories'	=> $this->inventories($group),

			'permissions'	=> $this->permissions($group),

            default => [],
        };
    }

	protected function assets(string $group): array
    {
        return match ($group) {

            'list' => Asset::where('status', true)
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray(),

            default => [],
        };
    }

	protected function attendances(string $group): array
	{
		return match ($group) {

			'batches' => AttendanceBatch::where('status', true)
				->orderBy('name')
				->pluck('name', 'id')
				->toArray(),

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

	protected function products(string $group): array
	{
		return match ($group) {

			'list' => Product::where('status', true)
				->orderBy('name')
				->pluck('name', 'id')
				->toArray(),

			default => [],
		};
	}

	protected function inventories(string $group): array
	{
    	return match ($group) {

	        'items-list' => InventoryItem::with('product')
    	        ->where('status', true)
        	    ->get()
            	->pluck('product.name', 'id')
            	->toArray(),

	        default => [],
    	};
	}

	protected function vendors(string $group): array
	{
		return match ($group) {

			'list' => Vendor::where('status', true)
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

	function consultations(string $group): array
	{
		return match ($group) {

			'list' => Consultation::where('status', true)
				->orderBy('name')
				->pluck('name', 'id')
				->toArray(),

			default => [],
		};
	}

	function centers(string $group): array
	{
		return match ($group) {

			'list' => Center::where('status', true)
				->orderBy('name')
				->pluck('name', 'id')
				->toArray(),

			default => [],
		};
	}

	function leads(string $group): array
	{
		return match ($group) {

			'list' => Lead::where('status', true)
				->orderBy('name')
				->pluck('name', 'id')
				->toArray(),

			default => [],
		};
	}

	protected function permissions(string $group): array
    {
        return match ($group) {

            'roles-list' => PermissionRole::where('tenant_id', tenant()->id) // or your helper
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
