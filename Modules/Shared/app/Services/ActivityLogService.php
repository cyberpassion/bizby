<?php

namespace Modules\Shared\Services;

use Modules\Shared\Models\ActivityLog;

class ActivityLogService
{
    public static function log(

        string $event,

        $subject = null,

        ?string $description = null,

        array $oldValues = [],

        array $newValues = [],

        array $meta = []
    ) {

        try {

            ActivityLog::create([

                'tenant_id' =>
                    tenant('id'),

                /*
                |--------------------------------------------------------------------------
                | CAUSER
                |--------------------------------------------------------------------------
                */

                'causer_type' =>
                    auth()->check()
                        ? 'user'
                        : null,

                'causer_id' =>
                    auth()->id(),

                /*
                |--------------------------------------------------------------------------
                | SUBJECT
                |--------------------------------------------------------------------------
                */

                'subject_type' =>
                    $subject
                        ? array_search(
                            get_class($subject),
                            \Illuminate\Database\Eloquent\Relations\Relation::morphMap()
                        )
                        : null,

                'subject_id' =>
                    $subject?->id,

                /*
                |--------------------------------------------------------------------------
                | EVENT
                |--------------------------------------------------------------------------
                */

                'event' => $event,

                'description' =>
                    $description,

                /*
                |--------------------------------------------------------------------------
                | CHANGES
                |--------------------------------------------------------------------------
                */

                'old_values' =>
                    $oldValues,

                'new_values' =>
                    $newValues,

                /*
                |--------------------------------------------------------------------------
                | REQUEST
                |--------------------------------------------------------------------------
                */

                'ip_address' =>
                    request()->ip(),

                'user_agent' =>
                    request()->userAgent(),

                'method' =>
                    request()->method(),

                'url' =>
                    request()->fullUrl(),

                /*
                |--------------------------------------------------------------------------
                | EXTRA
                |--------------------------------------------------------------------------
                */

                'meta' =>
                    $meta,
            ]);

        } catch (\Throwable $e) {

            report($e);
        }
    }
}