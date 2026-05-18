<?php

use Modules\Listing\Support\Actions;
use Modules\Listing\Support\Res;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Shared\Support\UrlPath;

$pg = 'listing';

return [

    'sidebar-menu' => [
        [
            'title' => ucfirst($pg),
            'href' => "/{$pg}",
            'permission' => Permission::access($pg),

            'items' => [

                [
                    'title' => 'Home',
                    'href' => UrlPath::makeHome($pg),
                    'permission' => Permission::view(Res::HOME),
                ],

                [
                    'title' => 'Add New',
                    'href' => UrlPath::makeCreate($pg),
                    'permission' => Permission::create(Res::LISTINGS),
                ],

                [
                    'title' => 'View List',
                    'href' => UrlPath::makeList($pg),
                    'permission' => Permission::list(Res::LISTINGS),
                ],

                [
                    'title' => 'Report',
                    'href' => UrlPath::makeReport($pg),
                    'permission' => Permission::view(Res::REPORTS),
                ],

                [
                    'title' => 'Settings',
                    'href' => UrlPath::makeSettings($pg),
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

        KeyName::make(Res::LISTINGS) => [
            Actions::LIST => [
                [
                    'title' => 'Section',
                    'href' => UrlPath::make($pg, 'section/{id}'),
                    'permission' => Permission::view(Res::DOCUMENTS),
                ],

                [
                    'title' => 'View Portal',
                    'href' => UrlPath::makePortal($pg, '{id}'),
                    'permission' => Permission::view(Res::DOCUMENTS),
                    'action' => 'external-link',
                ],

                [
                    'title' => 'Update',
                    'href' => UrlPath::makeUpdate($pg, '{id}'),
                    'permission' => Permission::update(Res::LISTINGS),
                    'action' => 'update',
                    'icon' => 'update',
                ],

                [
                    'title' => 'Upload',
                    'href' => UrlPath::makeUploads($pg, '{id}'),
                    'permission' => Permission::create(Res::UPLOADS),
                    'action' => 'upload',
                    'icon' => 'upload',
                ],

                [
                    'title' => 'Delete',
                    'href' => UrlPath::makeDelete(Res::LISTINGS, '{id}'),
                    'permission' => Permission::delete(Res::LISTINGS),
                    'action' => 'delete',
                    'method' => 'DELETE',
                    'variant' => 'danger',
                    'icon' => 'delete',
                ],
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | List Filters (Frontend)
    |--------------------------------------------------------------------------
    */
    'filters' => [

        KeyName::make(Res::LISTINGS) => [
            Actions::LIST => [
                [
                    'type' => 'select',
                    'name' => 'business_type',
                    'placeholder' => 'Business Type',
                    'col' => 3,
                    'dataKey' => 'shared.business-types',
                ],
                [
                    'type' => 'select',
                    'name' => 'state',
                    'placeholder' => 'State',
                    'col' => 3,
                    'dataKey' => 'shared.indian-states',
                ],
                [
                    'type' => 'select',
                    'name' => 'status',
                    'placeholder' => 'Status',
                    'col' => 3,
                    'dataKey' => 'listing.statuses',
                ],
            ],
        ],

    ],

];
