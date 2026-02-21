<?php

$pg = 'student';
$commonSettingsRoute = '/settings';

return [

    /* =====================================================
     | Sidebar Menu
     ===================================================== */
    'sidebar-menu-x' => [
        'title'      => ucfirst($pg),
        'href'       => "/{$pg}",
        'permission' => "{$pg}.access",
        'items'      => [

            /* Dashboard */
            [
                'title'      => 'Dashboard',
                'href'       => "/module/{$pg}/home",
                'permission' => "{$pg}.dashboard.view",
            ],

            /* Student Management */
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

            /* Academic Setup */
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

            /* Fee Management */
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

            /* Reports */
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

            /* Settings */
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

            /* Plugins */
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

    /* =====================================================
     | Single Student Actions
     ===================================================== */
    'student.single-actions' => [
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

    /* =====================================================
     | Lookups & Configs
     ===================================================== */

    'student.student-document-upload-type' => [
        'principal-signature' => 'Principal Signature',
        'cashier-signature'   => 'Cashier Signature',
        'fee-structure'       => 'Fee Structure Excel',
    ],

    'student.statuses' => [
        '1'   => 'Active',
        '11'  => 'Draft',
        '19'  => 'Promoted',
        '2'   => 'Deleted',
        '21'  => 'TC Generated',
        '22'  => 'Departed w/o TC',
        '23'  => 'Rusticated',
        '2x'  => 'Deleted (Other Reasons)',
        '127' => 'Cancelled',
    ],

    'student.crons' => [
        'student-birthday' => 'Student Birthday Message',
    ],

    'student.documents' => [
        'activity-undertaking'  => 'Activity Undertaking',
        'admission-form'        => 'Admission Form',
        'admit-card'            => 'Admit Card',
        'bonafide-certificate'  => 'Bonafide Certificate',
        'dob-certificate'       => 'DOB Certificate',
        'character-certificate' => 'Character Certificate',
        'fee-certificate'       => 'Fee Certificate',
        'student-id-card'       => 'ID Card',
        'medical-certificate'   => 'Medical Certificate',
        'transfer-certificate'  => 'Transfer Certificate',
        'fee-structure'         => 'Fee Structure',
    ],

];
