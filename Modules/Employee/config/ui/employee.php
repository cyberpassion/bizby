<?php
$pg = 'employee';
$commonSettingsRoute = '/settings';

return [

    'sidebar-menu' => [
        [
            'title'      => ucfirst($pg),
            'href'       => "/{$pg}",
            'permission' => "{$pg}.access",
            'items'      => [

                [
                    'title'      => 'Dashboard',
                    'href'       => "/module/{$pg}/home",
                    'permission' => "{$pg}.dashboard.view",
                ],

                [
                    'title' => 'Employees',
                    'items' => [
                        [
                            'title'      => 'Add Employee',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.employee.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.employee.view",
                        ],
                        [
                            'title'      => 'Bulk Operation',
                            'href'       => "/module/{$pg}/bulk",
                            'permission' => "{$pg}.employee.bulk",
                        ],
                    ],
                ],

                [
                    'title' => 'Salary',
                    'items' => [
                        [
                            'title'      => 'Salary Settings',
                            'href'       => "/module/{$pg}/settings/salary",
                            'permission' => "{$pg}.salary.settings",
                        ],
                        [
                            'title'      => 'Salary Report',
                            'href'       => "/module/{$pg}/report/salary",
                            'permission' => "{$pg}.salary.report",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Employee Report',
                            'href'       => "/module/{$pg}/report",
                            'permission' => "{$pg}.report.employee",
                        ],
                    ],
                ],

                [
                    'title' => 'Settings',
                    'items' => [
                        [
                            'title'      => 'Basic Settings',
                            'href'       => "/module/{$pg}/settings",
                            'permission' => "{$pg}.settings.basic",
                        ],
                    ],
                ],

                [
                    'title' => 'Plugins',
                    'items' => [
                        [
                            'title'      => 'Integrations',
                            'href'       => "/module/{$pg}/plugins",
                            'permission' => "{$pg}.plugin.manage",
                        ],
                    ],
                ],
            ],
        ],
    ],

    'employee.list-columns' => [
        'id',
        'name',
        'employee_type',
        'designation',
        'phone',
        'status',
    ],

    'employee.list-filters' => [
        'name',
        'employee_type',
        'designation',
        'phone',
        'status',
    ],

    'employee.report-columns' => [
        'id',
        'name',
        'employee_type',
        'designation',
        'gender',
        'age',
        'phone',
        'email',
        'date_of_joining',
        'job_location',
        'current_salary',
        'status',
    ],

];
