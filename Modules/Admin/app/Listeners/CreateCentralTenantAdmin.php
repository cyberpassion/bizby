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
        $tenant = TenantAccount::findOrFail($event->tenantId);
        app(TenantAdminService::class)->createCentralAdmin($tenant);
    }
}
