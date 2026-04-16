<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Registration\Support\Res;
use Modules\Registration\Support\Actions;

$pg = 'registration';

return [

    /*
    |--------------------------------------------------------------------------
    | Sidebar Menu
    |--------------------------------------------------------------------------
    */
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

                /*[
                    'title'      => '+ New',
                    'href'       => UrlPath::makeCreate($pg),
                    'permission' => Permission::create(Res::REGISTRATIONS),
                ],*/

                [
                    'title'      => 'View List',
                    'href'       => UrlPath::makeList($pg),
                    'permission' => Permission::list(Res::REGISTRATIONS),
                ],

                [
                    'title'      => 'Bulk-Ops',
                    'href'       => UrlPath::makeBulk($pg),
                    'permission' => Permission::bulk(Res::REGISTRATIONS),
                ],

                [
                    'title'      => 'Reports',
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
    | Row Actions (CRITICAL for Workflow Modules)
    |--------------------------------------------------------------------------
    */
    'single-actions' => [

        Actions::LIST => [

            [
                'title'      => 'Open Steps',
                'href'       => UrlPath::make($pg, '{id}/steps'),
                'permission' => Permission::view(Res::STEPS),
                'action'     => 'redirect',
            ],

            [
                'title'      => 'Documents',
                'href'       => UrlPath::make($pg, '{id}/documents'),
                'permission' => Permission::view(Res::DOCUMENTS),
                'action'     => 'redirect',
            ],

            [
                'title'      => 'Payments',
                'href'       => UrlPath::make($pg, '{id}/payments'),
                'permission' => Permission::view(Res::PAYMENTS),
                'action'     => 'redirect',
            ],

            [
                'title'      => 'Update',
                'href'       => UrlPath::makeUpdate($pg, '{id}'),
                'permission' => Permission::update(Res::REGISTRATIONS),
                'action'     => 'update',
            ],

            [
                'title'      => 'Delete',
                'href'       => UrlPath::makeDelete($pg, '{id}'),
                'permission' => Permission::delete(Res::REGISTRATIONS),
                'action'     => 'delete',
                'method'     => 'DELETE',
                'variant'    => 'danger',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Filters (List Screen)
    |--------------------------------------------------------------------------
    */
    'filters' => [

        Actions::LIST => [

            [
                'type'        => 'select',
                'name'        => 'type',
                'placeholder' => 'Registration Type',
                'col'         => 3,
                'dataKey'     => 'registration.types',
            ],

            [
                'type'        => 'select',
                'name'        => 'registration_status',
                'placeholder' => 'Status',
                'col'         => 3,
                'dataKey'     => 'registration.statuses',
            ]
        ],

    ],

];
