<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\Permission;
use Modules\Student\Support\Res;
use Modules\Student\Support\Actions;

$pg = 'student';

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
                    'title' => 'Students',
                    'items' => [
                        [
                            'title'      => 'Add Student',
                            'href'       => UrlPath::makeCreate($pg),
                            'permission' => Permission::create(Res::STUDENTS),
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => UrlPath::makeList($pg),
                            'permission' => Permission::list(Res::STUDENTS),
                        ],
                        [
                            'title'      => 'Transfer',
                            'href'       => UrlPath::make($pg, 'transfer'),
                            'permission' => Permission::update(Res::STUDENTS),
                        ],
                        [
                            'title'      => 'Bulk Operation',
                            'href'       => UrlPath::makeBulk($pg),
                            'permission' => Permission::bulk(Res::STUDENTS),
                        ],
                    ],
                ],

                [
                    'title' => 'Academic Setup',
                    'items' => [
                        [
                            'title'      => 'Academic Years',
                            'href'       => UrlPath::make($pg, 'academic-years'),
                            'permission' => Permission::view(Res::ACADEMIC),
                        ],
                        [
                            'title'      => 'Classes',
                            'href'       => UrlPath::make('shared', 'terms/student/classes'),
                            'permission' => Permission::view(Res::ACADEMIC),
                        ],
                        [
                            'title'      => 'Sections',
                            'href'       => UrlPath::make('shared', 'terms/student/sections'),
                            'permission' => Permission::view(Res::ACADEMIC),
                        ],
                    ],
                ],

                [
                    'title' => 'Fee Management',
                    'items' => [
                        [
                            'title'      => 'Fee Heads',
                            'href'       => UrlPath::make('shared', 'terms/student/fee-heads'),
                            'permission' => Permission::view(Res::FEES),
                        ],
                        [
                            'title'      => 'Fee Structure',
                            'href'       => UrlPath::make($pg, 'fee-structure'),
                            'permission' => Permission::update(Res::FEES),
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Student Report',
                            'href'       => UrlPath::make($pg, 'report-students'),
                            'permission' => Permission::view(Res::REPORTS),
                        ],
                        [
                            'title'      => 'Fee Collection',
                            'href'       => UrlPath::make($pg, 'report-fees'),
                            'permission' => Permission::view(Res::REPORTS),
                        ],
                        [
                            'title'      => 'Dues',
                            'href'       => UrlPath::make($pg, 'report-dues'),
                            'permission' => Permission::view(Res::REPORTS),
                        ],
                    ],
                ],

                [
                    'title' => 'Settings',
                    'items' => [
                        [
                            'title'      => 'Basic Settings',
                            'href'       => UrlPath::makeSettings($pg),
                            'permission' => Permission::update(Res::SETTINGS),
                        ],
                        [
                            'title'      => 'Admission Rules',
                            'href'       => UrlPath::make($pg, 'admission-rules'),
                            'permission' => Permission::update(Res::SETTINGS),
                        ],
                        [
                            'title'      => 'Fee Rules',
                            'href'       => UrlPath::make($pg, 'fee-rules'),
                            'permission' => Permission::update(Res::SETTINGS),
                        ],
                        [
                            'title'      => 'Other Settings',
                            'href'       => UrlPath::make($pg, 'other-section'),
                            'permission' => Permission::update(Res::SETTINGS),
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
                'title'      => 'View Documents',
                'href'       => UrlPath::make($pg, 'students/{id}/document'),
                'permission' => Permission::view(Res::DOCUMENTS),
                'action'     => 'document',
            ],

            [
                'title'      => 'Edit',
                'href'       => UrlPath::make($pg, 'students/{id}/edit'),
                'permission' => Permission::update(Res::STUDENTS),
                'action'     => 'update',
            ],

            [
                'title'      => 'Upload',
                'href'       => UrlPath::make($pg, 'students/{id}/upload'),
                'permission' => Permission::create(Res::UPLOADS),
                'action'     => 'upload',
            ],

            [
                'title'      => 'View Profile',
                'href'       => UrlPath::make($pg, 'students/{id}'),
                'permission' => Permission::view(Res::STUDENTS),
                'action'     => 'view',
            ],

            [
                'title'      => 'Delete',
                'href'       => UrlPath::make($pg, 'students/{id}'),
                'permission' => Permission::delete(Res::STUDENTS),
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
                'name'        => 'current_session',
                'placeholder' => 'Session',
                'col'         => 3,
                'dataKey'     => 'student.academic-years',
            ],
            [
                'type'        => 'select',
                'name'        => 'current_class',
                'placeholder' => 'Class',
                'col'         => 3,
                'dataKey'     => 'student.classes',
            ],
            [
                'type'        => 'select',
                'name'        => 'current_section',
                'placeholder' => 'Section',
                'col'         => 3,
                'dataKey'     => 'student.sections',
            ],
            [
                'type'        => 'select',
                'name'        => 'status',
                'placeholder' => 'Status',
                'col'         => 3,
                'dataKey'     => 'student.statuses',
            ],
        ]

    ],
];
