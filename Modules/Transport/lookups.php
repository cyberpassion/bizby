<?php
$pg = 'transport';
$commonSettingsRoute = '/settings';

return [
	'menuItem-transport' => [
    'admin' => [
        'parent' => [
            $pg => '#',
        ],
        'child' => [
            $pg => [
                ['New Vehicle Entry' => "/{$pg}/create"],
                ['View List'         => "/{$pg}/list"],
                ['Stops'             => "/{$pg}/stops"],
                ['Settings'          => "/{$pg}/settings"],
                [
                    'Plugin' => [
                        ['View Calendar' => "/{$pg}/calendar"],
                    ]
                ],
            ],
        ],
    ],
],

'sidebar-menu' => [
    [
        'title' => ucfirst($pg),
        'href'  => "/{$pg}",
        'items' => [
            ['title' => 'Home',              'href' => "/module/{$pg}/home"],
            ['title' => 'New Vehicle Entry', 'href' => "/module/{$pg}/new"],
            ['title' => 'View List',         'href' => "/module/{$pg}/list"],
            ['title' => 'Stops',             'href' => "/module/{$pg}/stops"],
            ['title' => 'Settings',          'href' => "/module/{$pg}/settings"],
            [
                'title' => 'Plugin',
                'items' => [
                    ['title' => 'View Calendar', 'href' => "/{$pg}/calendar"],
                ]
            ],
        ],
    ],
],

];