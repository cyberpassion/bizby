<?php

namespace Modules\Admin\Services\Tenants;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Admin\Services\Tenants\TenantDatabaseService;

use App\Models\Tenant as TenancyTenant;
use App\Models\User;

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
        $this->runMigrations($tenant);
        $this->createAdminUser($tenant);
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

        // Create physical DB
        if (! $dbService->create($databaseName)) {
            throw new \RuntimeException('Tenant database creation failed');
        }

        // Link tenancy → business tenant
        $tenant->update([
            'tenancy_id' => $tenancyTenant->id,
        ]);
    }

    /**
     * Run tenant migrations
     */
    protected function runMigrations(TenantAccount $tenant): void
    {
        Artisan::call('tenants:migrate', [
            '--tenants' => [$tenant->tenancy_id],
        ]);
    }

    /**
     * Create initial admin user inside tenant DB
     */
    protected function createAdminUser(TenantAccount $tenant): void
    {
        tenancy()->initialize($tenant->tenancy_id);

        User::firstOrCreate(
            ['email' => $tenant->email],
            [
                'name'     => $tenant->name,
                'password' => Hash::make(Str::random(16)),
                'role'     => 'admin',
            ]
        );

        tenancy()->end();
    }

    /**
     * Seed default data (roles, settings, etc.)
     */
    protected function seedDefaults(TenantAccount $tenant): void
    {
        tenancy()->initialize($tenant->tenancy_id);

        // Examples:
        // RoleSeeder::run();
        // SettingsSeeder::run();
        // Module defaults later
		Artisan::call('db:seed', [
        	'--class' => \Modules\Admin\Database\Seeders\AdminDatabaseSeeder::class,
        	'--force' => true,
    	]);

        tenancy()->end();
    }
}
