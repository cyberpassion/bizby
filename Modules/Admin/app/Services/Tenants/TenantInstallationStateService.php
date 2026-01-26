<?php

namespace Modules\Admin\Services\Tenants;

use Modules\Admin\Models\Tenants\TenantInstallation;
use Modules\Admin\Enums\Tenants\InstallationStatus;

class TenantInstallationStateService
{
    public function running(TenantInstallation $i, string $step, int $progress)
    {
        $i->update([
            'status' => InstallationStatus::RUNNING,
            'step' => $step,
            'progress' => $progress,
            'started_at' => $i->started_at ?? now(),
        ]);
    }

    public function completed(TenantInstallation $i)
    {
        $i->update([
            'status' => InstallationStatus::COMPLETED,
            'step' => null,
            'progress' => 100,
            'finished_at' => now(),
        ]);
    }

    public function failed(TenantInstallation $i, \Throwable $e)
    {
        $i->update([
            'status' => InstallationStatus::FAILED,
            'last_error' => $e->getMessage(),
            'logs' => array_merge($i->logs ?? [], [
                now()->toDateTimeString() => $e->getMessage()
            ]),
        ]);
    }
}
