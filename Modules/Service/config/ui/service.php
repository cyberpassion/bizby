<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Customer\Support\Res;
use Modules\Customer\Support\Actions;

$pg = 'service';

return [

    /* =========================
     | SIDEBAR MENU (UI)
     ========================= */
    'sidebar-menu-x' => [
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
