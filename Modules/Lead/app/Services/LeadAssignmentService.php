<?php

namespace Modules\Lead\Services;

use Modules\Lead\Models\Lead;
use Modules\Employee\Models\Employee;

class LeadAssignmentService
{
    public function assign(Lead $lead): void
    {
        $user = Employee::query()
            ->where('role', 'sales')
            ->orderBy('last_assigned_at')
            ->first();

        if (! $user) {
            return;
        }

        $lead->update([
            'assigned_to' => $user->id,
            'status' => 'assigned',
        ]);

        $user->update([
            'last_assigned_at' => now(),
        ]);
    }
}
