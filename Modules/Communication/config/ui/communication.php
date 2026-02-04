<?php
$pg = 'communication';

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
                    'title' => 'Send Communication',
                    'items' => [
                        [
                            'title'      => 'Send SMS',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.sms.send",
                        ],
                        [
                            'title'      => 'Send Email',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.email.send",
                        ],
                        [
                            'title'      => 'Send WhatsApp',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.whatsapp.send",
                        ],
                    ],
                ],

                [
                    'title' => 'Communication Logs',
                    'items' => [
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.communication.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Communication Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.communication",
                        ],
                    ],
                ],

                [
                    'title' => 'Templates',
                    'items' => [
                        [
                            'title'      => 'Add Template',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.template.create",
                        ],
                        [
                            'title'      => 'View Template List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.template.view",
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
     | Page Access (Portal)
     =============================== */
    'page-access-portal' => [
        ['pg' => $pg, 'sub_pg' => 'home'],
        ['pg' => $pg, 'sub_pg' => 'list'],
        ['pg' => $pg, 'sub_pg' => 'report'],
    ],

    /* ===============================
     | List Row Actions
     =============================== */
    'list-actions' => [
        'detail-update' => [
            'Edit'        => "{$pg}/entry/update",
            'Upload'      => "{$pg}/upload",
            'View Detail' => "{$pg}/detail",
        ],
    ],
];
