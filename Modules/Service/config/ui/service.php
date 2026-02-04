<?php
$pg = 'service';

return [

    /* =========================
     | SIDEBAR MENU (UI)
     ========================= */
    'sidebar-menu' => [
        [
            'title' => ucfirst($pg),
            'href'  => "/{$pg}",
            'items' => [

                [
                    'title' => 'Home',
                    'href'  => "/module/{$pg}/home",
                ],
                [
                    'title' => 'Add New',
                    'href'  => "/module/{$pg}/new",
                ],
                [
                    'title' => 'View List',
                    'href'  => "/module/{$pg}/list",
                ],
                [
                    'title' => 'Report',
                    'href'  => "/module/{$pg}/report",
                ],
                [
                    'title' => 'Settings',
                    'href'  => "/module/{$pg}/settings",
                ],
                [
                    'title' => 'Plugin',
                    'items' => [
                        [
                            'title' => 'View Calendar',
                            'href'  => "/plugin/calendar?module={$pg}",
                        ],
                    ],
                ],
            ],
        ],
    ],

];
