<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Examresult\Support\Res;
use Modules\Examresult\Support\Actions;

$pg = 'examresult';

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

                /*
                |--------------------------------------------------------------------------
                | Evaluations
                |--------------------------------------------------------------------------
                */
                [
                    'title'      => 'Create Evaluation',
                    'href'       => UrlPath::makeCreate("{$pg}/evaluations"),
                    'permission' => Permission::create(Res::EVALUATIONS),
                ],

                [
                    'title'      => 'View Evaluations',
                    'href'       => UrlPath::makeList("{$pg}/evaluations"),
                    'permission' => Permission::list(Res::EVALUATIONS),
                ],

                /*
                |--------------------------------------------------------------------------
                | Components
                |--------------------------------------------------------------------------
                */
                [
                    'title'      => 'Add Components',
                    'href'       => UrlPath::makeCreate("{$pg}/components"),
                    'permission' => Permission::create(Res::COMPONENTS),
                ],

                [
                    'title'      => 'View Components',
                    'href'       => UrlPath::makeList("{$pg}/components"),
                    'permission' => Permission::list(Res::COMPONENTS),
                ],

                /*
                |--------------------------------------------------------------------------
                | Results
                |--------------------------------------------------------------------------
                */
                [
                    'title'      => 'Enter Results',
                    'href'       => UrlPath::makeCreate("{$pg}/results"),
                    'permission' => Permission::create(Res::RESULTS),
                ],

                [
                    'title'      => 'View Results',
                    'href'       => UrlPath::makeList("{$pg}/results"),
                    'permission' => Permission::list(Res::RESULTS),
                ],

                [
                    'title'      => 'Bulk-Ops',
                    'href'       => UrlPath::makeBulk($pg),
                    'permission' => Permission::bulk(Res::RESULTS),
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
                'title'      => 'Manage Components',
                'href'       => UrlPath::make("{$pg}/evaluations", '{id}/components'),
                'permission' => Permission::view(Res::COMPONENTS),
                'action'     => 'redirect',
            ],

            [
                'title'      => 'Enter Results',
                'href'       => UrlPath::make("{$pg}/evaluations", '{id}/results'),
                'permission' => Permission::create(Res::RESULTS),
                'action'     => 'redirect',
            ],

            [
                'title'      => 'Update',
                'href'       => UrlPath::makeUpdate("{$pg}/evaluations", '{id}'),
                'permission' => Permission::update(Res::EVALUATIONS),
                'action'     => 'update',
            ],

            [
                'title'      => 'Delete',
                'href'       => UrlPath::makeDelete("{$pg}/evaluations", '{id}'),
                'permission' => Permission::delete(Res::EVALUATIONS),
                'action'     => 'delete',
                'method'     => 'DELETE',
                'variant'    => 'danger',
            ],
        ]

    ],

    /*
    |--------------------------------------------------------------------------
    | Filters (Example)
    |--------------------------------------------------------------------------
    */
    'filters' => [

        Actions::LIST => [

            [
                'type'        => 'select',
                'name'        => 'type',
                'placeholder' => 'Evaluation Type',
                'col'         => 3,
                'dataKey'     => 'examresult.types',
            ],

            [
                'type'        => 'select',
                'name'        => 'group_code',
                'placeholder' => 'Group',
                'col'         => 3,
                'dataKey'     => 'examresult.groups',
            ],

            [
                'type'        => 'date',
                'name'        => 'evaluation_date',
                'placeholder' => 'Date',
                'col'         => 3,
            ],
        ]

    ],

];
