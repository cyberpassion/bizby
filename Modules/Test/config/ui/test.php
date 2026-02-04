<?php
$pg = 'test';

return [

    'sidebar-menu' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => "{$pg}.access",
            'items'      => [

                /* Single Test */
                [
                    'title' => 'Single Test',
                    'items' => [
                        [
                            'title'      => 'Create New',
                            'href'       => "/module/{$pg}/single/create",
                            'permission' => "{$pg}.single.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/single/list",
                            'permission' => "{$pg}.single.view",
                        ],
                        [
                            'title'      => 'View Report',
                            'href'       => "/module/{$pg}/single/report",
                            'permission' => "{$pg}.single.report",
                        ],
                    ],
                ],

                /* Package Test */
                [
                    'title' => 'Package Test',
                    'items' => [
                        [
                            'title'      => 'Create New',
                            'href'       => "/module/{$pg}/package/create",
                            'permission' => "{$pg}.package.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/package/list",
                            'permission' => "{$pg}.package.view",
                        ],
                        [
                            'title'      => 'View Report',
                            'href'       => "/module/{$pg}/package/report",
                            'permission' => "{$pg}.package.report",
                        ],
                    ],
                ],

                /* Pool */
                [
                    'title'      => 'Pool',
                    'href'       => "/module/{$pg}/pool",
                    'permission' => "{$pg}.pool.manage",
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
