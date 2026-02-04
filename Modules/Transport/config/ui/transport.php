<?php
$pg = 'transport';

return [

/*
|--------------------------------------------------------------------------
| UI : Sidebar Menu & Screens
|--------------------------------------------------------------------------
*/
'sidebar-menu' => [
    [
        'title'      => ucfirst($pg),
        'href'       => "/{$pg}",
        'permission' => "{$pg}.access",
        'items'      => [

            [
                'title'      => 'Home',
                'href'       => "/module/{$pg}/home",
                'permission' => "{$pg}.dashboard.view",
            ],
            [
                'title'      => 'New Vehicle Entry',
                'href'       => "/module/{$pg}/new",
                'permission' => "{$pg}.vehicle.create",
            ],
            [
                'title'      => 'View List',
                'href'       => "/module/{$pg}/list",
                'permission' => "{$pg}.vehicle.view",
            ],
            [
                'title'      => 'Stops',
                'href'       => "/module/{$pg}/stops",
                'permission' => "{$pg}.stops.manage",
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
