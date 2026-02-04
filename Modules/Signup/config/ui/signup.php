<?php
$pg = 'signup';

return [

    'sidebar-menu' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => "{$pg}.access",
            'items'      => [

                /* =========================
                 | Dashboard
                 ========================= */
                [
                    'title'      => 'Dashboard',
                    'href'       => "/module/{$pg}/home",
                    'permission' => "{$pg}.dashboard.view",
                ],

                /* =========================
                 | Signup Management
                 ========================= */
                [
                    'title' => 'Signups',
                    'items' => [
                        [
                            'title'      => 'Add New',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.signup.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.signup.view",
                        ],
                    ],
                ],

                /* =========================
                 | Reports
                 ========================= */
                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Signup Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.signup",
                        ],
                    ],
                ],

                /* =========================
                 | Settings
                 ========================= */
                [
                    'title'      => 'Settings',
                    'href'       => "/module/{$pg}/settings",
                    'permission' => "{$pg}.settings.manage",
                ],

                /* =========================
                 | Plugins
                 ========================= */
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
