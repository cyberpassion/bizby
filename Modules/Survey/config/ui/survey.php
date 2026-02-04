<?php
$pg = 'survey';

return [

    'sidebar-menu' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => "{$pg}.access",
            'items'      => [

                /* Dashboard */
                [
                    'title'      => 'Dashboard',
                    'href'       => "/module/{$pg}/home",
                    'permission' => "{$pg}.dashboard.view",
                ],

                /* Survey Management */
                [
                    'title' => 'Surveys',
                    'items' => [
                        [
                            'title'      => 'Add New',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.survey.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.survey.view",
                        ],
                    ],
                ],

                /* Reports */
                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Survey Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.survey",
                        ],
                    ],
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
