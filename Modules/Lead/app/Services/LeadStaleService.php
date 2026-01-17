<?php

namespace Modules\Lead\Services;

use Modules\Lead\Models\Lead;

class LeadStaleService
{
    public function markStale(): void
    {
        Lead::query()
            ->whereNull('converted_at')
            ->where('status', '!=', 'stale')
            ->where('updated_at', '<=', now()->subDays(14))
            ->chunkById(200, function ($leads) {
                foreach ($leads as $lead) {
                    $lead->update([
                        'status' => 'stale',
                        'stale_at' => now(),
                    ]);
                }
            });
    }
}
