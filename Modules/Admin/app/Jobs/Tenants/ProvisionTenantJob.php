<?php

namespace Modules\Admin\Jobs\Tenants;

use Throwable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Admin\Models\Tenants\TenantInstallation;
use Modules\Admin\Services\Tenants\TenantProvisioningService;
use Modules\Admin\Services\Tenants\TenantDatabaseService;

use Stancl\Tenancy\Facades\Tenancy;

class ProvisionTenantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // OLD
    // public function __construct(public int $tenantId) {}

    // NEW
    public function __construct(public int $installationId) {}

    public function handle(
        TenantProvisioningService $provisioningService,
        TenantDatabaseService $dbService
    ) {
        // 🔒 Always force central context in queue jobs
        Tenancy::end();

        // Load installation & tenant
        $install = TenantInstallation::findOrFail($this->installationId);
        $tenant  = TenantAccount::findOrFail($install->tenant_id);

        // OLD idempotency
        // if ($tenant->tenancy_id) {
        //     return;
        // }

        // NEW idempotency (installation-aware)
        if ($install->status === \Modules\Admin\Enums\Tenants\InstallationStatus::COMPLETED) {
            return;
        }

        // Delegate ALL logic to service
        $provisioningService->provision($tenant, $install, $dbService);

        // Fire event AFTER successful provisioning
        event(new \Modules\Admin\Events\TenantActivated($tenant->id));
    }

    public function failed(Throwable $e): void
    {
        // OLD (buggy – tenantId no longer exists)
        // TenantAccount::where('id', $this->tenantId)
        //     ->update(['status' => 'failed']);

        // NEW (safe)
        $install = TenantInstallation::find($this->installationId);
        if ($install) {
            $install->update([
                'status' => \Modules\Admin\Enums\Tenants\InstallationStatus::FAILED,
                'last_error' => $e->getMessage(),
            ]);
        }

        report($e);
    }
}
