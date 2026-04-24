<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Product\Support\Res;
use Modules\Product\Support\Actions;

$pg = 'product';

return [

    /* ===============================
     | Sidebar Menu
     =============================== */
    'sidebar-menu' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => Permission::access($pg),

            'items' => [

                [
                    'title'      => 'Home',
                    'href'       => UrlPath::makeHome($pg),
                    'permission' => Permission::view(Res::HOME),
                ],

                /*
                |--------------------------------------------------------------------------
                | Product
                |--------------------------------------------------------------------------
                */
                [
                    'title'      => 'Add Product',
                    'href'       => UrlPath::makeCreate($pg),
                    'permission' => Permission::create(Res::PRODUCTS),
                ],

                [
                    'title'      => 'View List',
                    'href'       => UrlPath::makeList($pg),
                    'permission' => Permission::list(Res::PRODUCTS),
                ],

                [
                    'title'      => 'Report',
                    'href'       => UrlPath::makeReport($pg),
                    'permission' => Permission::view(Res::REPORTS),
                ],

                /*
                |--------------------------------------------------------------------------
                | Settings
                |--------------------------------------------------------------------------
                */
                [
                    'title'      => 'Settings',
                    'href'       => UrlPath::makeSettings($pg),
                    'permission' => Permission::update(Res::SETTINGS),
                ],

                /*
                |--------------------------------------------------------------------------
                | Plugins
                |--------------------------------------------------------------------------
                */
                [
                    'title'      => 'Calendar',
                    'href'       => "/plugin/calendar?module={$pg}",
                    'permission' => Permission::access("{$pg}.plugin"),
                ],

            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Row Actions
    |--------------------------------------------------------------------------
    */
    'single-actions' => [

        Actions::LIST => [

			[
                'title'      => 'View Details',
                'href'       => UrlPath::makeDetail($pg, '{id}'),
                'permission' => Permission::view(Res::DOCUMENTS),
                'action'     => 'detail',
            ],

            [
                'title'      => 'Update',
                'href'       => UrlPath::makeUpdate($pg, '{id}'),
                'permission' => Permission::update(Res::PRODUCTS),
                'action'     => 'update',
            ],

            [
                'title'      => 'Delete',
                'href'       => UrlPath::makeDelete($pg, '{id}'),
                'permission' => Permission::delete(Res::PRODUCTS),
                'action'     => 'delete',
                'method'     => 'DELETE',
                'variant'    => 'danger',
            ],

        ]

    ],

    /*
    |--------------------------------------------------------------------------
    | List Filters (Frontend)
    |--------------------------------------------------------------------------
    */
    'filters' => [

        Actions::LIST => [

            [
                'type'        => 'select',
                'name'        => 'brand',
                'placeholder' => 'Brand',
                'col'         => 3,
                'dataKey'     => 'product.brand-names',
            ],

            [
                'type'        => 'select',
                'name'        => 'availability',
                'placeholder' => 'Availability',
                'col'         => 3,
                'dataKey'     => 'product.availability-statuses',
            ],

        ]

    ],

];