<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Inventory\Support\Res;
use Modules\Inventory\Support\Actions;

$pg = 'inventory';

return [

    'sidebar-menu' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => Permission::access($pg),

            'items' => [

                [
                    'title'      => 'Dashboard',
                    'href'       => UrlPath::makeHome($pg),
                    'permission' => Permission::view(Res::HOME),
                ],

				[
                	'title'      => 'Add Item',
                    'href'       => UrlPath::makeCreate($pg),
                    'permission' => Permission::create(Res::INVENTORIES),
                ],
				[
                    'title'      => 'Add Transaction',
                    'href'       => UrlPath::make($pg, 'transactions/create'),
                    'permission' => Permission::create(Res::INVENTORIES),
                ],
				[
                    'title'      => 'View List',
                    'href'       => UrlPath::makeList($pg),
                    'permission' => Permission::list(Res::INVENTORIES),
                ],
				[
                    'title'      => 'Report',
                    'href'       => UrlPath::makeReport($pg),
                    'permission' => Permission::view(Res::REPORTS),
                ],
				[
                    'title'      => 'Settings',
                    'href'       => UrlPath::makeSettings($pg),
                    'permission' => Permission::update(Res::SETTINGS),
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
                'title'      => 'View Detail',
                'href'       => UrlPath::makeDocuments($pg, '{id}'),
                'permission' => Permission::view(Res::DOCUMENTS),
                'action'     => 'document',
            ],

            [
                'title'      => 'Add Stock',
                'href'       => UrlPath::make($pg, 'create-transactions/?inventory_item_id={id}'),
                'permission' => Permission::create(Res::INVENTORIES),
                'variant'    => 'success'
            ],

            [
                'title'      => 'Update',
                'href'       => UrlPath::makeUpdate($pg, '{id}'),
                'permission' => Permission::update(Res::INVENTORIES),
                'action'     => 'update',
            ],

            [
                'title'      => 'Delete',
                'href'       => UrlPath::makeDelete($pg, '{id}'),
                'permission' => Permission::delete(Res::INVENTORIES),
                'action'     => 'delete',
                'method'     => 'DELETE',
                'variant'    => 'danger',
            ],
        ]

    ],

    /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    */
    'filters' => [

        Actions::LIST => [
            [
                'type'        => 'select',
                'name'        => 'product_id',
                'placeholder' => 'Product',
                'col'         => 3,
                'dataKey'     => 'products.list',
            ],
			[
                'type'        => 'select',
                'name'        => 'status',
                'placeholder' => 'Status',
                'col'         => 3,
                'dataKey'     => 'inventory.statuses',
            ],
        ]

    ],

];