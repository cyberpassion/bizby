<?php
$pg = 'customer';
$commonSettingsRoute = '/settings';

return [

    'sidebar-menu' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => "{$pg}.access",
            'items'      => [

                [
                    'title'      => 'Dashboard',
                    'href'       => "/module/{$pg}/home",
                    'permission' => "{$pg}.dashboard.view",
                ],

                [
                    'title' => 'Customers',
                    'items' => [
                        [
                            'title'      => 'Add Customer',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.customer.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.customer.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Customer Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.customer",
                        ],
                    ],
                ],

                [
                    'title' => 'Settings',
                    'items' => [
                        [
                            'title'      => 'Basic Settings',
                            'href'       => "/module/{$pg}/settings",
                            'permission' => "{$pg}.settings.basic",
                        ],
                    ],
                ],

                [
                    'title' => 'Plugins',
                    'items' => [
                        [
                            'title'      => 'Integrations',
                            'href'       => "/module/{$pg}/plugins",
                            'permission' => "{$pg}.plugin.manage",
                        ],
                    ],
                ],
            ],
        ],
    ],

    'customer.list-columns' => [
        'id',
        'name',
        'phone',
        'customer_type',
        'business_type',
        'status',
    ],

    'customer.list-filters' => [
        'name',
        'phone',
        'customer_type',
        'business_type',
        'status',
    ],

    'customer.report-columns' => [
        'id',
        'name',
        'customer_type',
        'business_type',
        'phone',
        'email',
        'state',
        'status',
    ],

];
