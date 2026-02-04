<?php
$pg = 'listing';

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

                /* Listing Management */
                [
                    'title' => 'Listings',
                    'items' => [
                        [
                            'title'      => 'Add Listing',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.listing.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.listing.view",
                        ],
                    ],
                ],

                /* Reports */
                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Listing Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.listing",
                        ],
                    ],
                ],

                /* Settings */
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
