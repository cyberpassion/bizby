<?php

use Modules\Center\Support\Actions;
use Modules\Center\Support\Res;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Shared\Support\UrlPath;

$pg = 'center';

return [

    'sidebar-menu' => [
        [
            'title' => ucfirst($pg),
            'href' => "/{$pg}",
            'permission' => Permission::access($pg),

            'items' => [

                [
                    'title' => 'Home',
                    'description' => 'Station Dashboard & Overview',
                    'href' => UrlPath::makeHome($pg),
                    'permission' => Permission::view(Res::HOME),
                ],

                [
                    'title' => 'Add New',
                    'description' => 'Create a New Station',
                    'href' => UrlPath::makeCreate($pg),
                    'permission' => Permission::create(Res::CENTERS),
                ],

                [
                    'title' => 'View List',
                    'description' => 'Browse All Stations',
                    'href' => UrlPath::makeList($pg),
                    'permission' => Permission::list(Res::CENTERS),
                ],

                [
                    'title' => 'Report',
                    'description' => 'View Station Reports',
                    'href' => UrlPath::makeReport($pg),
                    'permission' => Permission::view(Res::REPORTS),
                ],

                [
                    'title' => 'Settings',
                    'description' => 'Manage Station Settings',
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

        KeyName::make(Res::CENTERS) => [
            Actions::LIST => [
                [
                    'title' => 'View Details',
                    'href' => UrlPath::makeDetail($pg, '{id}'),
                    'permission' => Permission::view(Res::DOCUMENTS),
                    'action' => 'detail',
                    'icon' => 'view',
                ],

                [
                    'title' => 'Edit',
                    'href' => UrlPath::makeUpdate($pg, '{id}'),
                    'permission' => Permission::update(Res::CENTERS),
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
                    'href' => UrlPath::makeDelete(Res::CENTERS, '{id}'),
                    'permission' => Permission::delete(Res::CENTERS),
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

        KeyName::make(Res::CENTERS) => [
            Actions::LIST => [
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
                    'dataKey' => 'center.statuses',
                ],
            ],
        ],

    ],

];
