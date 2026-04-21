<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Note\Support\Res;
use Modules\Note\Support\Actions;

$pg = 'note';

return [

    /* =========================
     | Sidebar Menu
     ========================= */
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
                    'title'      => 'Add Note',
                    'href'       => UrlPath::makeCreate($pg),
                    'permission' => Permission::create(Res::NOTES),
                ],

                [
                    'title'      => 'View List',
                    'href'       => UrlPath::makeList($pg),
                    'permission' => Permission::list(Res::NOTES),
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
                'title'      => 'Edit',
                'href'       => UrlPath::makeUpdate($pg, '{id}'),
                'permission' => Permission::update(Res::NOTES),
                'action'     => 'update',
            ],

            [
                'title'      => 'Delete',
                'href'       => UrlPath::makeDelete($pg, '{id}'),
                'permission' => Permission::delete(Res::NOTES),
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
                'name'        => 'status',
                'placeholder' => 'Status',
                'col'         => 3,
                'dataKey'     => 'note.statuses',
            ],
        ]

    ],

];