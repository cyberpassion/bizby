<?php

namespace Modules\Shared\Notifications\Services;

use Illuminate\Support\Facades\DB;

class NotificationAuditService
{
    public function log(array $data): int
    {
        return DB::table('notification_audits')->insertGetId([
            ...$data,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function markFailed(int $id, string $error): void
    {
        DB::table('notification_audits')
            ->where('id', $id)
            ->update([
                'status' => 'failed',
                'error'  => $error,
                'updated_at' => now(),
            ]);
    }
}
