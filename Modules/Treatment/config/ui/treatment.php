<?php
$pg = 'treatment';

return [

/*
|--------------------------------------------------------------------------
| UI : Sidebar Menu (Treatment)
|--------------------------------------------------------------------------
*/
'sidebar-menu' => [
    [
        'title'      => ucfirst($pg),
        'href'       => "/{$pg}",
        'permission' => "{$pg}.access",
        'items'      => [

            /* Treatment Management */
            [
                'title' => 'Treatment',
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
                        'title'      => 'View Report',
                        'href'       => "/module/{$pg}/report",
                        'permission' => "{$pg}.report",
                    ],
                ],
            ],

            /* Settings */
            [
                'title'      => 'Settings',
                'href'       => "/module/{$pg}/settings",
                'permission' => "{$pg}.settings",
            ],

            /* Plugins */
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

];
