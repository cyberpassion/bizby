<?php
$pg = 'note';

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
                    'title' => 'Notes',
                    'items' => [
                        [
                            'title'      => 'Add Note',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.note.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.note.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Note Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.note",
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
            ],
        ],
    ],

    /* =========================
     | Portal / Admin Permissions
     ========================= */
    "permissionPortal-note" => [
        'restricted' => [],
        'allowed'    => [
            ['pg' => $pg, 'sub_pg' => 'home'],
            ['pg' => $pg, 'sub_pg' => 'list'],
            ['pg' => $pg, 'sub_pg' => 'report'],
            ['pg' => $pg, 'sub_pg' => 'note-report'],
        ]
    ],

    "permissionAdmin-note" => [
        'restricted'=> [
            '2' => [['pg' => $pg, 'sub_pg' => 'settings']],
            '3' => [['pg' => $pg, 'sub_pg' => 'settings']]
        ],
        'allowed' => []
    ],

];
