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
                'title'       => 'Home',
                'description' => 'Employee Dashboard & Overview',
                'href'        => UrlPath::makeHome($pg),
                'permission'  => 'employee.access',
            ],

            [
                'title' => 'Employees',
                'description' => 'Manage Employee Records & Operations',
                'items' => [
                    [
                        'title'       => 'Add Employee',
                        'description' => 'Create a New Employee Profile',
                        'href'        => UrlPath::makeCreate($pg),
                        'permission'  => Permission::create(Res::EMPLOYEES),
                    ],
                    [
                        'title'       => 'View List',
                        'description' => 'Browse All Employees',
                        'href'        => UrlPath::makeList($pg),
                        'permission'  => Permission::list(Res::EMPLOYEES),
                    ],
                    /*[
                        'title'       => 'Bulk-Ops',
                        'description' => 'Perform Bulk Employee Actions',
                        'href'        => UrlPath::makeBulk($pg),
                        'permission'  => Permission::bulk(Res::EMPLOYEES),
                    ],*/
                    [
                        'title'       => 'Report',
                        'description' => 'View Employee Reports',
                        'href'        => UrlPath::makeReport($pg),
                        'permission'  => Permission::view(Res::REPORTS),
                    ],
                    [
                        'title'       => 'Settings',
                        'description' => 'Manage Employee Settings',
                        'href'        => UrlPath::makeSettings($pg),
                        'permission'  => Permission::update(Res::SETTINGS),
                    ],
                ],
            ],

            /*[
                'title' => 'Salary',
                'description' => 'Manage Salary & Payroll Settings',
                'items' => [
                    [
                        'title'       => 'Report',
                        'description' => 'View Salary Reports',
                        'href'        => UrlPath::make($pg, 'report/salary'),
                        'permission'  => Permission::view(Res::SALARY),
                    ],
                    [
                        'title'       => 'Settings',
                        'description' => 'Configure Salary Settings',
                        'href'        => UrlPath::make($pg, 'settings/salary'),
                        'permission'  => Permission::update(Res::SALARY),
                    ],
                ],
            ],*/

            [
                'title' => 'Plugins',
                'description' => 'Extend Employee Module with Integrations',
                'items' => [
                    [
                        'title'       => 'Integrations',
                        'description' => 'Manage External Integrations',
                        'href'        => UrlPath::makePlugins($pg),
                        'permission'  => Permission::view(Res::PLUGINS),
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
                'title'      => 'View Documents',
                'href'       => UrlPath::makeDocuments($pg, '{id}'),
                'permission' => Permission::view(Res::DOCUMENTS),
                'action'     => 'document',
            ],

			[
                'title'      => 'View Profile',
                'href'       => UrlPath::makeProfile($pg, '{id}'),
                'permission' => Permission::view(Res::EMPLOYEES),
                'action'     => 'view',
            ],

            [
                'title'      => 'Edit',
                'href'       => UrlPath::makeUpdate($pg, '{id}'),
                'permission' => Permission::update(Res::EMPLOYEES),
                'action'     => 'update',
            ],

            [
                'title'      => 'Upload',
                'href'       => UrlPath::makeUploads($pg, '{id}'),
                'permission' => Permission::create(Res::UPLOADS),
                'action'     => 'upload',
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
                'placeholder' => 'Type',
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
