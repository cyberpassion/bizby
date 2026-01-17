<?php

return [

    'SendLeadFollowupReminders' => [
        'module' => 'Lead',
        'class' => \Modules\Lead\Jobs\SendLeadFollowupReminders::class,

        // UI-friendly name
        'name' => 'Lead Follow-up Reminder Notifications',

        // Detailed description for admins
        'description' => 'Automatically sends reminder notifications to sales representatives for leads that are due for follow-up. This ensures no lead is missed and helps improve conversion rates by maintaining timely communication with prospects.',

        'defaults' => [
            'frequency' => 'daily',
            'time' => '10:00',
        ],

        'allowed_frequencies' => ['daily', 'weekly', 'monthly', 'cron'],
    ],

    'MarkStaleLeads' => [
        'module' => 'Lead',
        'class' => \Modules\Lead\Jobs\MarkStaleLeads::class,

        'name' => 'Mark Inactive Leads as Stale',

        'description' => 'Scans all open leads and automatically marks leads as stale if they have had no activity or updates for a defined period of time. This helps keep the CRM clean, improves reporting accuracy, and allows teams to focus on active opportunities.',

        'defaults' => [
            'frequency' => 'daily',
            'time' => '01:00',
        ],

        'allowed_frequencies' => ['daily', 'weekly', 'monthly', 'cron'],
    ],

    'AutoAssignNewLeads' => [
        'module' => 'Lead',
        'class' => \Modules\Lead\Jobs\AutoAssignNewLeads::class,

        'name' => 'Auto-Assign New Leads to Sales Team',

        'description' => 'Automatically assigns newly created leads to available sales representatives based on predefined assignment rules such as round-robin or workload balancing. This ensures faster response times and fair lead distribution across the sales team.',

        'defaults' => [
            'frequency' => 'every_5_minutes',
        ],

        'allowed_frequencies' => ['every_5_minutes', 'hourly', 'cron'],
    ],

];
