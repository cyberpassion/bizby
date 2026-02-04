<?php
$pg = 'subscription';

return [

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
                    'title' => 'Subscriptions',
                    'items' => [
                        [
                            'title'      => 'Add New',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.subscription.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.subscription.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Subscription Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.subscription",
                        ],
                    ],
                ],

                [
                    'title'      => 'Settings',
                    'href'       => "/module/{$pg}/settings",
                    'permission' => "{$pg}.settings.manage",
                ],

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
