<?php
$pg = 'vendor';

return [

/*
|--------------------------------------------------------------------------
| UI : Sidebar Menu (Vendor)
|--------------------------------------------------------------------------
*/
'sidebar-menu' => [
    [
        'title'      => ucfirst($pg),
        'href'       => "/{$pg}",
        'permission' => "{$pg}.access",
        'items'      => [

            /* Dashboard */
            [
                'title'      => 'Dashboard',
                'href'       => "/module/{$pg}/home",
                'permission' => "{$pg}.dashboard.view",
            ],

            /* Vendor Management */
            [
                'title' => 'Vendors',
                'items' => [
                    [
                        'title'      => 'Add Vendor',
                        'href'       => "/module/{$pg}/new",
                        'permission' => "{$pg}.vendor.create",
                    ],
                    [
                        'title'      => 'View List',
                        'href'       => "/module/{$pg}/list",
                        'permission' => "{$pg}.vendor.view",
                    ],
                ],
            ],

            /* Contracts / Documents */
            [
                'title' => 'Contracts',
                'items' => [
                    [
                        'title'      => 'Agreements',
                        'href'       => "/module/{$pg}/agreements",
                        'permission' => "{$pg}.contract.manage",
                    ],
                    [
                        'title'      => 'Invoices',
                        'href'       => "/module/{$pg}/invoices",
                        'permission' => "{$pg}.invoice.manage",
                    ],
                ],
            ],

            /* Reports */
            [
                'title' => 'Reports',
                'items' => [
                    [
                        'title'      => 'Vendor Report',
                        'href'       => "/module/{$pg}/report-vendors",
                        'permission' => "{$pg}.report.vendor",
                    ],
                    [
                        'title'      => 'Payment Report',
                        'href'       => "/module/{$pg}/report-payments",
                        'permission' => "{$pg}.report.payment",
                    ],
                ],
            ],

            /* Settings */
            [
                'title' => 'Settings',
                'items' => [
                    [
                        'title'      => 'Basic Settings',
                        'href'       => "/module/{$pg}/settings",
                        'permission' => "{$pg}.settings.basic",
                    ],
                    [
                        'title'      => 'Payment Rules',
                        'href'       => "/module/{$pg}/payment-rules",
                        'permission' => "{$pg}.settings.payment",
                    ],
                ],
            ],

            /* Plugins */
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

];
