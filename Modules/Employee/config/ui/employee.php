<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Employee\Support\Res;
use Modules\Employee\Support\Actions;

$pg = 'employee';

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
                    'title' => 'Employees',
                    'items' => [
                        [
                            'title'      => 'Add Employee',
                            'href'       => UrlPath::makeCreate($pg),
                            'permission' => Permission::create(Res::EMPLOYEES),
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => UrlPath::makeList($pg),
                            'permission' => Permission::list(Res::EMPLOYEES),
                        ],
                        [
                            'title'      => 'Bulk Operation',
                            'href'       => UrlPath::makeBulk($pg),
                            'permission' => Permission::bulk(Res::EMPLOYEES),
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

                [
                    'title' => 'Salary',
                    'items' => [
						[
                            'title'      => 'Report',
                            'href'       => UrlPath::make($pg, 'report/salary'),
                            'permission' => Permission::view(Res::SALARY),
                        ],
                        [
                            'title'      => 'Settings',
                            'href'       => UrlPath::make($pg, 'settings/salary'),
                            'permission' => Permission::update(Res::SALARY),
                        ],
                    ],
                ],

                [
                    'title' => 'Plugins',
                    'items' => [
                        [
                            'title'      => 'Integrations',
                            'href'       => UrlPath::makePlugins($pg),
                            'permission' => Permission::view(Res::PLUGINS),
                        ],
                    ],
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
                'title'      => 'View Slip',
                'href'       => UrlPath::make($pg, '{id}/document'),
                'permission' => Permission::view(Res::DOCUMENTS),
                'action'     => 'document',
            ],

            [
                'title'      => 'Edit',
                'href'       => UrlPath::makeUpdate($pg, '{id}'),
                'permission' => Permission::update(Res::EMPLOYEES),
                'action'     => 'update',
            ],

            [
                'title'      => 'Upload',
                'href'       => UrlPath::makeUpload($pg, '{id}'),
                'permission' => Permission::create(Res::UPLOADS),
                'action'     => 'upload',
            ],

            [
                'title'      => 'View Profile',
                'href'       => UrlPath::makeView($pg),
                'permission' => Permission::view(Res::EMPLOYEES),
                'action'     => 'view',
            ],

            [
                'title'      => 'Delete',
                'href'       => UrlPath::makeDelete($pg, '{id}'),
                'permission' => Permission::delete(Res::EMPLOYEES),
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
                'name'        => 'employee_type',
                'placeholder' => 'Employee Type',
                'col'         => 3,
                'dataKey'     => 'employee.types',
            ],

            [
                'type'        => 'select',
                'name'        => 'designation',
                'placeholder' => 'Designation',
                'col'         => 3,
                'dataKey'     => 'employee.designations',
            ],

            [
                'type'        => 'select',
                'name'        => 'status',
                'placeholder' => 'Status',
                'col'         => 3,
                'dataKey'     => 'employee.statuses',
            ],
        ]

    ],

];
