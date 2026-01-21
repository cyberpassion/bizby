<?php
namespace Modules\Admin\Jobs\Tenants;

use Throwable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Admin\Services\Tenants\TenantProvisioningService;
use Modules\Admin\Services\Tenants\TenantDatabaseService;

use Stancl\Tenancy\Facades\Tenancy;

class ProvisionTenantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $tenantId
    ) {}

    public function handle(
        TenantProvisioningService $provisioningService,
        TenantDatabaseService $dbService
    ) {

		Tenancy::end(); // VERY IMPORTANT

	    $tenant = TenantAccount::findOrFail($this->tenantId);

	    if ($tenant->tenancy_id) {
    	    return; // idempotent
    	}

	    $provisioningService->provision($tenant, $dbService);

	    event(new \Modules\Admin\Events\TenantActivated($tenant->id));

    }

    public function failed(Throwable $e): void
    {
        TenantAccount::where('id', $this->tenantId)
            ->update(['status' => 'failed']);

        report($e);
    }
}
