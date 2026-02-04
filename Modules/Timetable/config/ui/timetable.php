<?php
$pg = 'timetable';

return [

    'sidebar-menu' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => "{$pg}.access",
            'items'      => [

                /* Add New */
                [
                    'title'      => 'Add New',
                    'href'       => "/module/{$pg}/new",
                    'permission' => "{$pg}.create",
                ],

                /* View List */
                [
                    'title'      => 'View List',
                    'href'       => "/module/{$pg}/list",
                    'permission' => "{$pg}.view",
                ],

                /* View Report */
                [
                    'title'      => 'View Report',
                    'href'       => "/module/{$pg}/report",
                    'permission' => "{$pg}.report",
                ],

                /* Settings */
                [
                    'title'      => 'Settings',
                    'href'       => "/module/{$pg}/settings",
                    'permission' => "{$pg}.settings.manage",
                ],

                /* Plugins */
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
