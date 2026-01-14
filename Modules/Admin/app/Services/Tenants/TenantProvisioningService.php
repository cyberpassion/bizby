<?php

namespace Modules\Admin\Services\Tenants;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Admin\Services\Tenants\TenantDatabaseService;

use App\Models\Tenant as TenancyTenant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\Facades\Tenancy;

class TenantProvisioningService
{
    public function provision(
        TenantAccount $tenant,
        TenantDatabaseService $dbService
    ): void {
        // 🔐 Idempotency guard
        if ($tenant->tenancy_id) {
            return;
        }

        $this->createDatabase($tenant, $dbService);
        $this->seedDefaults($tenant);
    }

    /**
     * Create tenancy record + physical database
     */
    protected function createDatabase(
        TenantAccount $tenant,
        TenantDatabaseService $dbService
    ): void {
        $tenantId = $tenant->id;

        $databaseName =
            config('tenancy.database.prefix')
            . $tenantId
            . config('tenancy.database.suffix');

        // Create tenancy tenant (infra)
        $tenancyTenant = TenancyTenant::create([
            'id'              => $tenantId,
            'tenancy_db_name' => $databaseName,
        ]);

        // Link tenancy → business tenant
        $tenant->update([
            'tenancy_id' => $tenancyTenant->id,
        ]);
    }

    /**
     * Seed default data (roles, settings, etc.)
     */
    protected function seedDefaults(TenantAccount $tenant): void
	{	
    	Artisan::call('tenants:seed', [
	        '--tenants' => [$tenant->id],
    	    '--class'   => \Modules\Shared\Database\Seeders\SharedDatabaseSeeder::class,
        	'--force'   => true,
	    ]);
	}

}
