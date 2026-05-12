<?php
namespace Modules\Admin\Listeners;

use Modules\Admin\Events\TenantActivated;
use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Admin\Services\Tenants\TenantAdminService;
use Stancl\Tenancy\Facades\Tenancy;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateCentralTenantAdmin implements ShouldQueue
{
    public function handle(TenantActivated $event): void
    {
		logger()->info('Listening to generated event', ['file' => __FILE__,'line' => __LINE__,'method' => __METHOD__,]);
        $tenant = TenantAccount::findOrFail($event->tenantId);
        app(TenantAdminService::class)->createCentralAdmin($tenant);
    }
}
