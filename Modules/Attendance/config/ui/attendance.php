<?php

$pg = 'attendance';

return [

    /*
    |----------------------------------------------------------------------
    | Sidebar Menu
    |----------------------------------------------------------------------
    */
    'sidebar_menu' => [
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
                    'title' => 'Attendance',
                    'items' => [
                        [
                            'title'      => 'Add Attendance',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.attendance.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.attendance.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Attendance Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.attendance",
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

    /*
    |----------------------------------------------------------------------
    | List Filters (Frontend)
    |----------------------------------------------------------------------
    */
    'list_filters' => [
        [
            'type'        => 'select',
            'name'        => 'session',
            'placeholder' => 'Select Session',
            'col'         => 3,
            'dataKey'     => 'attendance.session',
        ],
        [
            'type'        => 'select',
            'name'        => 'month',
            'placeholder' => 'Select Month',
            'col'         => 3,
            'dataKey'     => 'attendance.month',
        ],
        [
            'type'        => 'select',
            'name'        => 'is_paid',
            'placeholder' => 'Paid / Unpaid',
            'col'         => 3,
            'dataKey'     => 'attendance.paid_unpaid',
        ],
        [
            'type'        => 'date',
            'name'        => 'absent_date',
            'placeholder' => 'Absent Date',
            'col'         => 3,
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Portal Permissions
    |----------------------------------------------------------------------
    */
    'permission_portal' => [
        'allowed' => [
            ['pg' => $pg, 'sub_pg' => 'home'],
            ['pg' => $pg, 'sub_pg' => 'list'],
            ['pg' => $pg, 'sub_pg' => 'report'],
        ],
    ],

];
