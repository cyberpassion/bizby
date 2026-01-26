<?php
namespace Modules\Admin\Services\Tenants;

use Modules\Admin\Models\Tenants\TenantInstallation;

class InstallationRunner
{
    public function run(TenantInstallation $install, callable $callback)
    {
        $install->update([
            'attempts' => $install->attempts + 1,
        ]);

        try {
            $install->markRunning();

            $callback($install);

            $install->markCompleted();

        } catch (\Throwable $e) {
            $install->markFailed($e);
            throw $e; // queue retry safe
        }
    }
}
