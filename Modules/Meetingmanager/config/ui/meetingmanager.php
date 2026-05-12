<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Customer\Support\Res;
use Modules\Customer\Support\Actions;

$pg = 'meetingmanager';

return [

    'sidebar-menu-x' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => "{$pg}.access",
            'items'      => [

                /* Dashboard */
                [
                    'title'      => 'Home',
                    'href'       => "/module/{$pg}/home",
                    'permission' => "{$pg}.dashboard.view",
                ],

                /* Meeting Management */
                [
                    'title' => 'Meetings',
                    'items' => [
                        [
                            'title'      => 'Add Meeting',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.meeting.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.meeting.view",
                        ],
                    ],
                ],

                /* Reports */
                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Meeting Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.meeting",
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
