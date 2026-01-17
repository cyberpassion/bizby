<?php
return [
    'SendTenantUpcomingRenewals' => [
        'class' => \Modules\Admin\Jobs\Tenants\SendTenantUpcomingRenewals::class,
        'description' => 'Send renewal reminder emails',

        'defaults' => [
            'frequency' => 'daily',
            'time' => '09:00',
        ],

        'allowed_frequencies' => ['daily', 'weekly', 'monthly', 'cron'],
    ],
];
