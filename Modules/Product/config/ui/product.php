<?php
$pg = 'product';

return [

    /* =========================
     | Sidebar & Navigation (UI)
     ========================= */
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
                    'title' => 'Products',
                    'items' => [
                        [
                            'title'      => 'Add Product',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.product.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.product.view",
                        ],
                        [
                            'title'      => 'Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.product",
                        ],
                    ],
                ],

                [
                    'title' => 'Stock',
                    'items' => [
                        [
                            'title'      => 'Add Stock',
                            'href'       => "/module/{$pg}/stock/create",
                            'permission' => "{$pg}.stock.create",
                        ],
                        [
                            'title'      => 'Stock List',
                            'href'       => "/module/{$pg}/stock/list",
                            'permission' => "{$pg}.stock.view",
                        ],
                        [
                            'title'      => 'Stock Report',
                            'href'       => "/module/{$pg}/stock/report",
                            'permission' => "{$pg}.report.stock",
                        ],
                        [
                            'title'      => 'Stock Settings',
                            'href'       => "/module/{$pg}/stock/settings",
                            'permission' => "{$pg}.settings.stock",
                        ],
                    ],
                ],

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
