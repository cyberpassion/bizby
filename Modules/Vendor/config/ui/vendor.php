<?php

use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Shared\Support\UrlPath;
use Modules\Vendor\Support\Actions;
use Modules\Vendor\Support\Res;

$pg = 'vendor';

return [

    /* ===============================
     | Sidebar Menu
     =============================== */
    'sidebar-menu' => [
        [
            'title' => ucfirst($pg),
            'href' => "/{$pg}",
            'permission' => Permission::access($pg),

            'items' => [

                [
                    'title' => 'Home',
                    'description' => 'Vendor Dashboard & Overview',
                    'href' => UrlPath::makeHome($pg),
                    'permission' => Permission::view(Res::HOME),
                ],

                [
                    'title' => 'Add New',
                    'description' => 'Create a New Vendor Profile',
                    'href' => UrlPath::makeCreate($pg),
                    'permission' => Permission::create(Res::VENDORS),
                ],

                [
                    'title' => 'View List',
                    'description' => 'Browse All Vendors',
                    'href' => UrlPath::makeList($pg),
                    'permission' => Permission::list(Res::VENDORS),
                ],

                [
                    'title' => 'Report',
                    'description' => 'View Vendor Reports & Analytics',
                    'href' => UrlPath::makeReport($pg),
                    'permission' => Permission::view(Res::REPORTS),
                ],

                [
                    'title' => 'Settings',
                    'description' => 'Manage Vendor Settings',
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

        KeyName::make(Res::VENDORS) => [
            Actions::LIST => [

                [
                    'title' => 'View Profile',
                    'href' => UrlPath::makeProfile($pg, '{id}'),
                    'permission' => Permission::view(Res::PROFILE),
                    'action' => 'view',
                    'icon' => 'profile',
                ],

                [
                    'title' => 'View Details',
                    'href' => UrlPath::makeDetail($pg, '{id}'),
                    'permission' => Permission::view(Res::DOCUMENTS),
                    'action' => 'detail',
                    'icon' => 'view',
                ],

                [
                    'title' => 'Update',
                    'href' => UrlPath::makeUpdate($pg, '{id}'),
                    'permission' => Permission::update(Res::VENDORS),
                    'action' => 'update',
                    'icon' => 'update',
                ],

                [
                    'title' => 'Upload',
                    'href' => UrlPath::makeUploads($pg, '{id}'),
                    'permission' => Permission::create(Res::DOCUMENTS),
                    'action' => 'upload',
                    'icon' => 'upload',
                ],

                [
                    'title' => 'Delete',
                    'href' => UrlPath::makeDelete(Res::VENDORS, '{id}'),
                    'permission' => Permission::delete(Res::VENDORS),
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

        KeyName::make(Res::VENDORS) => [
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
                    'name' => 'vendor_type',
                    'placeholder' => 'Vendor Type',
                    'col' => 3,
                    'dataKey' => 'shared.business-types',
                ],
                [
                    'type' => 'select',
                    'name' => 'status',
                    'placeholder' => 'Status',
                    'col' => 3,
                    'dataKey' => 'vendor.statuses',
                ],
            ],
        ],

    ],

];
