<?php

return [

    'SendTenantUpcomingRenewals' => [
        'module' => 'Admin',
        'class'  => \Modules\Admin\Jobs\Tenants\SendTenantUpcomingRenewals::class,

        // UI-friendly name
        'name' => 'Tenant Subscription Renewal Reminders',

        // Detailed admin description
        'description' => 'Automatically sends reminder emails to tenants whose subscriptions are nearing renewal. This helps reduce churn, ensures timely renewals, and provides tenants with sufficient notice to continue their services without interruption.',

        'defaults' => [
            'frequency' => 'daily',
            'time' => '09:00',
        ],

        'allowed_frequencies' => ['daily', 'weekly', 'monthly', 'cron'],
    ],

];
