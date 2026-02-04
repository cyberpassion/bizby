<?php
$pg = 'contact';

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
                    'title' => 'Contacts',
                    'items' => [
                        [
                            'title'      => 'Add Contact',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.contact.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.contact.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Contact Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.contact",
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
     | Portal Page Access
     =============================== */
    'page-access-portal' => [
        ['pg' => $pg, 'sub_pg' => 'home'],
        ['pg' => $pg, 'sub_pg' => 'profile'],
        ['pg' => $pg, 'sub_pg' => 'document'],
        ['pg' => $pg, 'sub_pg' => 'history'],
    ],

    /* ===============================
     | List Row Actions
     =============================== */
    'list-actions' => [
        'detail-update' => [
            'Profile'       => "{$pg}/profile",
            'Edit'          => "{$pg}/entry/update",
            'Upload'        => "{$pg}/upload",
            'View Details'  => "{$pg}/detail",
            'View History'  => "{$pg}/history",
            'Download Docs' => '#',
        ],
    ],
];
