<?php
$pg = 'registration';

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

                [
                    'title'      => 'Dashboard',
                    'href'       => "/module/{$pg}/home",
                    'permission' => "{$pg}.dashboard.view",
                ],

                [
                    'title' => 'Manage',
                    'items' => [
                        [
                            'title'      => 'Add New',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.view",
                        ],
                        [
                            'title'      => 'Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.view",
                        ],
                        [
                            'title'      => 'Settings',
                            'href'       => "/module/{$pg}/settings",
                            'permission' => "{$pg}.settings.manage",
                        ],
                    ],
                ],

                [
                    'title' => 'Plugins',
                    'items' => [
                        [
                            'title'      => 'View Calendar',
                            'href'       => "/plugin/calendar?module={$pg}",
                            'permission' => "{$pg}.plugin.calendar",
                        ],
                    ],
                ],

            ],
        ],
    ],

    /* =========================
     | UI PAGE ACCESS CONTROL
     ========================= */
    "permissionAdmin-registration" => [
        'restricted'=> [
            '2' => [['pg' => $pg, 'sub_pg' => 'settings']],
            '3' => [['pg' => $pg, 'sub_pg' => 'settings']],
        ],
        'allowed' => []
    ],

    "permissionRestrictedAdmin-module" => [
        ['pg' => $pg, 'sub_pg' => 'settings']
    ],

    "permissionPortal-registration" => [
        'restricted' => [],
        'allowed'    => [
            ['pg' => $pg, 'sub_pg' => 'home'],
            ['pg' => $pg, 'sub_pg' => 'profile'],
            ['pg' => $pg, 'sub_pg' => 'list'],
            ['pg' => $pg, 'sub_pg' => 'detail'],
            ['pg' => $pg, 'sub_pg' => 'document'],
            ['pg' => $pg, 'sub_pg' => 'history'],
            ['pg' => $pg, 'sub_pg' => 'upload'],
            ['pg' => $pg, 'sub_pg' => 'report'],
            ['pg' => $pg, 'sub_pg' => "{$pg}-report"],
        ]
    ],

];
