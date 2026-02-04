<?php
$pg = 'saleservice';

return [

    /* =========================
     | SIDEBAR & UI ROUTES
     ========================= */
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

                /* Sales */
                [
                    'title' => 'Sales',
                    'items' => [
                        [
                            'title'      => 'Add New',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.sale.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.sale.view",
                        ],
                    ],
                ],

                /* Reports */
                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Sale Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.sale",
                        ],
                    ],
                ],

                /* Settings */
                [
                    'title'      => 'Settings',
                    'href'       => "/module/{$pg}/settings",
                    'permission' => "{$pg}.settings.manage",
                ],

                /* Plugins */
                [
                    'title' => 'Plugins',
                    'items' => [
                        [
                            'title'      => 'View Calendar',
                            'href'       => "/plugin/calendar?module={$pg}",
                            'permission' => "{$pg}.plugin.manage",
                        ],
                    ],
                ],
            ],
        ],
    ],

];
