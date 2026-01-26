<?php

namespace Modules\Admin\Services\Tenants;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Admin\Models\Tenants\TenantInstallation;
use Modules\Admin\Services\Tenants\TenantDatabaseService;
use App\Models\Tenant as TenancyTenant;
use Stancl\Tenancy\Facades\Tenancy;

use Modules\Admin\Services\Tenants\TenantInstallationStateService;

class TenantProvisioningService
{
    public function __construct(
        protected TenantInstallationStateService $state
    ) {}

    /**
     * Main provisioning entry (called by Job)
     */
    public function provision(
        TenantAccount $tenant,
        TenantInstallation $install,
        TenantDatabaseService $dbService
    ): void {
        if ($tenant->tenancy_id) {
            return;
        }

        tenancy()->central(function () use ($tenant, $install, $dbService) {

            $this->state->running($install, 'start', 1);

            $tenant->update([
                'status' => 'provisioning',
                'provision_started_at' => now(),
            ]);

            try {
                // -------- PHASE 1: CENTRAL --------
                $this->state->running($install, 'create_database', 10);
                $this->createDatabase($tenant, $dbService);

                // -------- PHASE 2: TENANT -------- MIGRATION IS DONE AUTOMATICALLY AFTER DATABASE CREATION
                // $this->state->running($install, 'migrate', 40);
                // $this->runTenantMigrations($tenant);

				// -------- PHASE 2: TENANT SEEDING --------
                $this->state->running($install, 'seed', 60);
                $this->seedDefaults($tenant);

                // -------- PHASE 3: CENTRAL --------
                $this->state->running($install, 'subscription', 80);
                $this->createInitialSubscription($tenant);

                $this->state->running($install, 'activate', 95);
                $tenant->update([
                    'status' => 'active',
                    'provisioned_at' => now(),
                ]);

                $this->state->completed($install);

            } catch (\Throwable $e) {
                $this->state->failed($install, $e);
                $tenant->update(['status' => 'failed']);
                throw $e;
            }
        });
    }

    /**
     * CENTRAL: create infra
     */
    public function createDatabase(
        TenantAccount $tenant,
        TenantDatabaseService $dbService
    ): void {
        $tenantId = $tenant->id;

        TenancyTenant::create([
            'id' => $tenantId,
            'tenancy_db_name' =>
                config('tenancy.database.prefix')
                . $tenantId
                . config('tenancy.database.suffix'),
        ]);

        $tenant->update(['tenancy_id' => $tenantId]);
    }

    /**
     * TENANT: migrate
     */
    public function runTenantMigrations(TenantAccount $tenant): void
    {
        Tenancy::initialize($tenant->id);

        Artisan::call('tenants:migrate', [
            '--tenants' => [$tenant->id],
            '--force'   => true,
        ]);

        Tenancy::end();
    }

    /**
     * TENANT: seed
     */
    public function seedDefaults(TenantAccount $tenant): void
    {
        Tenancy::initialize($tenant->id);

        Artisan::call('tenants:seed', [
            '--tenants' => [$tenant->id],
            '--class'   => \Modules\Shared\Database\Seeders\SharedDatabaseSeeder::class,
            '--force'   => true,
        ]);

        Tenancy::end();
    }

    /**
     * CENTRAL: subscription
     */
    public function createInitialSubscription(TenantAccount $tenant): void
    {
        DB::connection('central')->table('tenant_subscriptions')->insert([
            'tenant_id'  => $tenant->id,
            'plan'       => 'trial',
            'amount'     => 0,
            'starts_at'  => now(),
            'ends_at'    => now()->addDays(14),
            'status'     => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $tenant->update([
            'plan'       => 'trial',
            'valid_till' => now()->addDays(14),
        ]);
    }
}
