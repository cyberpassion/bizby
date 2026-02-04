<?php

$pg = 'announcement';
$commonSettingsRoute = '/settings';

return [

    /*
    |--------------------------------------------------------------------------
    | Sidebar Menu
    |--------------------------------------------------------------------------
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
                    'title' => 'Announcements',
                    'items' => [
                        [
                            'title'      => 'Add Announcement',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.announcement.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.announcement.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Announcement Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.announcement",
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

    /*
    |--------------------------------------------------------------------------
    | List Filters (Frontend – FULL CONFIG)
    |--------------------------------------------------------------------------
    */
    'list_filters' => [
        [
            'type'        => 'date',
            'name'        => 'date',
            'placeholder' => 'Announcement Date',
            'col'         => 3,
        ],
        [
            'type'        => 'select',
            'name'        => 'category',
            'placeholder' => 'Category',
            'col'         => 3,
            'dataKey'     => 'announcement.categories',
        ],
        [
            'type'        => 'select',
            'name'        => 'status',
            'placeholder' => 'Status',
            'col'         => 3,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Portal Allowed Filters
    |--------------------------------------------------------------------------
    */
    'permission_allowed_filters_portal' => [
        'entry'  => [['recipient' => '{$login_type}-{$byline}']],
        'list'   => [['recipient' => '{$login_type}-{$byline}']],
        'report' => [['recipient' => '{$login_type}-{$byline}']],
    ],

    /*
    |--------------------------------------------------------------------------
    | Permissions
    |--------------------------------------------------------------------------
    */
    'permission_admin' => [
        'restricted' => [
            '2' => [['pg' => $pg, 'sub_pg' => 'settings']],
            '3' => [['pg' => $pg, 'sub_pg' => 'settings']],
        ],
        'allowed' => [],
    ],

    'permission_portal' => [
        'restricted' => [],
        'allowed' => [
            ['pg' => $pg, 'sub_pg' => 'home'],
            ['pg' => $pg, 'sub_pg' => 'list'],
            ['pg' => $pg, 'sub_pg' => 'detail'],
            ['pg' => $pg, 'sub_pg' => 'report'],
            ['pg' => $pg, 'sub_pg' => 'history'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Form Prefills
    |--------------------------------------------------------------------------
    */
    'form_prefills' => [
        'columns' => [
            'product'      => 'default_product',
            'contact_mode' => 'default_contact_mode',
            'state'        => 'default_indian_state',
        ],
        'groups' => [
            'current_date' => ['contact_date'],
        ],
    ],

];
