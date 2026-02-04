<?php
$pg = 'eventmanager';
$commonSettingsRoute = '/settings';

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
                    'title' => 'Events',
                    'items' => [
                        [
                            'title'      => 'Add Event',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.event.create",
                        ],
                        [
                            'title'      => 'Event List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.event.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Event Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.view",
                        ],
                    ],
                ],

                [
                    'title' => 'Settings',
                    'items' => [
                        [
                            'title'      => 'Event Settings',
                            'href'       => "/module/{$pg}/settings",
                            'permission' => "{$pg}.settings.manage",
                        ],
                    ],
                ],

                [
                    'title' => 'Plugins',
                    'items' => [
                        [
                            'title'      => 'Calendar View',
                            'href'       => "/plugin/calendar?module={$pg}",
                            'permission' => "{$pg}.plugin.calendar",
                        ],
                    ],
                ],
            ],
        ],
    ],

    'eventmanager.list-columns' => [
        'id',
        'event_name',
        'event_type',
        'event_start_date',
        'event_end_date',
        'status',
    ],

    'eventmanager.list-filters' => [
        'event_name',
        'event_type',
        'event_start_date',
        'event_end_date',
        'status',
    ],

    'eventmanager.report-columns' => [
        'id',
        'event_name',
        'event_type',
        'event_start_date',
        'event_end_date',
        'participant',
        'event_participants',
        'event_description',
        'event_remark',
        'status',
    ],

];
