<?php
$pg = 'patient';

return [

    /* =========================
     | Sidebar & UI Navigation
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
                    'title' => 'Patients',
                    'items' => [
                        [
                            'title'      => 'Add Patient',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.patient.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.patient.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Patient Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.patient",
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
                            'title'      => 'View Calendar',
                            'href'       => "/plugin/calendar?module={$pg}",
                            'permission' => "{$pg}.plugin.manage",
                        ],
                    ],
                ],
            ],
        ],
    ],

    /* =========================
     | Admin / Portal Permissions
     ========================= */
    "permissionAdmin-patient" => [
        'restricted'=> [
            '2' => [['pg' => $pg, 'sub_pg' => 'settings']],
            '3' => [['pg' => $pg, 'sub_pg' => 'settings']]
        ],
        'allowed' => []
    ],

    "permissionRestrictedAdmin-module" => [
        ['pg' => $pg, 'sub_pg' => 'settings']
    ],

    "permissionPortal-patient" => [
        'restricted' => [],
        'allowed' => [
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

    "permissionAllowedPortal-module" => [
        ['pg' => $pg, 'sub_pg' => 'home'],
        ['pg' => $pg, 'sub_pg' => 'profile'],
        ['pg' => $pg, 'sub_pg' => 'list'],
        ['pg' => $pg, 'sub_pg' => 'detail'],
        ['pg' => $pg, 'sub_pg' => 'document'],
        ['pg' => $pg, 'sub_pg' => 'history'],
        ['pg' => $pg, 'sub_pg' => 'upload'],
        ['pg' => $pg, 'sub_pg' => 'report'],
        ['pg' => $pg, 'sub_pg' => "{$pg}-report"],
    ],

];
