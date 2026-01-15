<?php

namespace Modules\Shared\Notifications\Services;

use Illuminate\Support\Facades\DB;

class TenantNotificationPreferenceService
{
    public function enabled(
        int $tenantId,
        string $activityKey,
        string $channel
    ): bool {
        return DB::table('tenant_notification_settings')
            ->where([
                'tenant_id'   => $tenantId,
                'activity_key'=> $activityKey,
                'channel'     => $channel,
                'enabled'     => true,
            ])
            ->exists();
    }
}
