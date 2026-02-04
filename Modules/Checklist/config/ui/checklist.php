<?php
$pg = 'checklist';

return [

    /* ===============================
     | Sidebar Menu
     =============================== */
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
                    'title' => 'Checklists',
                    'items' => [
                        [
                            'title'      => 'Add Checklist',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.checklist.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.checklist.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Plans',
                    'items' => [
                        [
                            'title'      => 'Create New',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.plan.create",
                        ],
                        [
                            'title'      => 'View Plan List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.plan.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Checklist Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.checklist",
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

    /* ===============================
     | Page Access (Portal/Admin)
     =============================== */
    'page-access-portal' => [
        ['pg' => $pg, 'sub_pg' => 'home'],
        ['pg' => $pg, 'sub_pg' => 'entry'],
        ['pg' => $pg, 'sub_pg' => 'list'],
        ['pg' => $pg, 'sub_pg' => 'listing-point-list'],
        ['pg' => $pg, 'sub_pg' => 'history'],
        ['pg' => $pg, 'sub_pg' => 'report'],
        ['pg' => $pg, 'sub_pg' => "{$pg}-report"],
    ],

    /* ===============================
     | List Row Actions
     =============================== */
    'list-actions' => [
        'detail-update' => [
            'Edit'          => "{$pg}/entry/update",
            'Update Points' => "{$pg}/complete-entry/new",
            'Upload'        => "{$pg}/upload",
            'View History'  => "{$pg}/history",
            'Report'        => "{$pg}/document",
        ],
    ],
];
