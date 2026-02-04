<?php

$pg = 'student';

return [

    /*
    |--------------------------------------------------------------------------
    | Sidebar Menu
    |--------------------------------------------------------------------------
    */
    'sidebar_menu' => [
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
                    'title' => 'Students',
                    'items' => [
                        [
                            'title'      => 'Add Student',
                            'href'       => "/module/{$pg}/new",
                            'permission' => "{$pg}.student.create",
                        ],
                        [
                            'title'      => 'View List',
                            'href'       => "/module/{$pg}/list",
                            'permission' => "{$pg}.student.view",
                        ],
                        [
                            'title'      => 'Transfer',
                            'href'       => "/module/{$pg}/transfer",
                            'permission' => "{$pg}.student.transfer",
                        ],
                    ],
                ],

                [
                    'title' => 'Academic Setup',
                    'items' => [
                        [
                            'title'      => 'Academic Years',
                            'href'       => "/module/{$pg}/academic-years",
                            'permission' => "{$pg}.academic_year.manage",
                        ],
                        [
                            'title'      => 'Classes',
                            'href'       => "/module/shared/terms/student/classes",
                            'permission' => "{$pg}.class.manage",
                        ],
                        [
                            'title'      => 'Sections',
                            'href'       => "/module/shared/terms/student/sections",
                            'permission' => "{$pg}.section.manage",
                        ],
                    ],
                ],

                [
                    'title' => 'Fee Management',
                    'items' => [
                        [
                            'title'      => 'Fee Heads',
                            'href'       => "/module/shared/terms/student/fee-heads",
                            'permission' => "{$pg}.fee_head.manage",
                        ],
                        [
                            'title'      => 'Fee Structure',
                            'href'       => "/module/{$pg}/fee-structure",
                            'permission' => "{$pg}.fee_structure.manage",
                        ],
                    ],
                ],

                [
                    'title' => 'Reports',
                    'items' => [
                        [
                            'title'      => 'Student Report',
                            'href'       => "/module/{$pg}/report-students",
                            'permission' => "{$pg}.report.student",
                        ],
                        [
                            'title'      => 'Fee Collection',
                            'href'       => "/module/{$pg}/report-fees",
                            'permission' => "{$pg}.report.fee",
                        ],
                        [
                            'title'      => 'Dues',
                            'href'       => "/module/{$pg}/report-dues",
                            'permission' => "{$pg}.report.dues",
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
                        [
                            'title'      => 'Admission Rules',
                            'href'       => "/module/{$pg}/admission-rules",
                            'permission' => "{$pg}.settings.admission",
                        ],
                        [
                            'title'      => 'Fee Rules',
                            'href'       => "/module/{$pg}/fee-rules",
                            'permission' => "{$pg}.settings.fee",
                        ],
                        [
                            'title'      => 'Other Settings',
                            'href'       => "/module/{$pg}/other-section",
                            'permission' => "{$pg}.settings.other",
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

    /*
    |--------------------------------------------------------------------------
    | Single Row Actions (per student)
    |--------------------------------------------------------------------------
    */
    'single_actions' => [
        [
            'title'      => 'View Slip',
            'href'       => "/module/{$pg}/students/{id}/document",
            'permission' => "{$pg}.student.document",
            'action'     => 'document',
        ],
        [
            'title'      => 'Edit',
            'href'       => "/module/{$pg}/students/{id}/edit",
            'permission' => "{$pg}.student.update",
            'action'     => 'update',
        ],
        [
            'title'      => 'Upload',
            'href'       => "/module/{$pg}/students/{id}/upload",
            'permission' => "{$pg}.student.upload",
            'action'     => 'upload',
        ],
        [
            'title'      => 'View Profile',
            'href'       => "/module/{$pg}/students/{id}",
            'permission' => "{$pg}.student.view",
            'action'     => 'view',
        ],
        [
            'title'      => 'Delete',
            'href'       => "/module/{$pg}/students/{id}",
            'permission' => "{$pg}.student.delete",
            'action'     => 'delete',
            'method'     => 'DELETE',
            'variant'    => 'danger',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | List Filters (FULL CONFIG – used by frontend)
    |--------------------------------------------------------------------------
    */
    'list_filters' => [
        [
            'type'        => 'select',
            'name'        => 'current_session',
            'placeholder' => 'Select Student Session',
            'col'         => 3,
            'dataKey'     => 'student.academic-years',
        ],
        [
            'type'        => 'select',
            'name'        => 'current_class',
            'placeholder' => 'Select Student Current Class',
            'col'         => 3,
            'dataKey'     => 'student.classes',
        ],
        [
            'type'        => 'select',
            'name'        => 'current_section',
            'placeholder' => 'Select Student Current Section',
            'col'         => 3,
            'dataKey'     => 'student.sections',
        ],
        [
            'type'        => 'select',
            'name'        => 'status',
            'placeholder' => 'Select Student Status',
            'col'         => 3,
            'dataKey'     => 'student.statuses',
        ],
    ],

];
