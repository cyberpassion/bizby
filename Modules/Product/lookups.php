<?php
$pg = 'product';
$commonSettingsRoute = '/settings';

return [
	'menuItem-product' => [
    'admin' => [
        'parent' => [
            $pg => '#',
        ],
        'child' => [
            $pg => [
                ['Add New'   => "/{$pg}/create"],
                ['View List' => "/{$pg}/list"],
                ['Report'    => "/{$pg}/report"],
                [
                    'Stock' => [
                        ['Add New'   => "/{$pg}/stock/create"],
                        ['View List' => "/{$pg}/stock/list"],
                        ['Report'    => "/{$pg}/stock/report"],
                        ['Settings'  => "/{$pg}/stock/settings"],
                    ]
                ],
                ['Settings' => "/{$pg}/settings"],
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
            ['title' => 'Home',      'href' => "/module/{$pg}/home"],
            ['title' => 'Add New',   'href' => "/module/{$pg}/new"],
            ['title' => 'View List', 'href' => "/module/{$pg}/list"],
            ['title' => 'Report',    'href' => "/module/{$pg}/report"],
            [
                'title' => 'Stock',
                'items' => [
                    ['title' => 'Add New',   'href' => "/{$pg}/stock/create"],
                    ['title' => 'View List', 'href' => "/{$pg}/stock/list"],
                    ['title' => 'Report',    'href' => "/{$pg}/stock/report"],
                    ['title' => 'Settings',  'href' => "/{$pg}/stock/settings"],
                ]
            ],
            ['title' => 'Settings', 'href' => "/module/{$pg}/settings"],
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
