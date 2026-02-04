<?php
$pg = 'student';
$commonSettingsRoute = '/settings';

return [
    'student.sidebar-menu' => [
    [
        'title'      => ucfirst($pg),
        'href'       => "/{$pg}",
        'permission' => "{$pg}.access",
        'items'      => [

            /* =========================
             | Dashboard
             ========================= */
            [
                'title'      => 'Dashboard',
                'href'       => "/module/{$pg}/home",
                'permission' => "{$pg}.dashboard.view",
            ],

            /* =========================
             | Student Management
             ========================= */
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

            /* =========================
             | Academic Setup
             ========================= */
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

            /* =========================
             | Fee Management
             ========================= */
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

            /* =========================
             | Reports
             ========================= */
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

            /* =========================
             | Settings
             ========================= */
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

            /* =========================
             | Plugins
             ========================= */
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

'student.single_actions' => [
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



    "student.student-document-upload-type" => [
                        /*"logo"						=> "Logo",
                        "watermark"					=> "Watermark",
                        "cover-image"				=> "Cover Image",
                        "document-border"			=> "Document Border",*/
                        "principal-signature"		=> "Principal Signature",
                        "cashier-signature"			=> "Cashier Signature",
                        "fee-structure"				=> "Fee Structure Excel"
    ],
    // New Lookups
	"student.statuses" => [
                        '1'		=>	'Active',
                        '11'	=>	'Draft',
                        '19'	=>	'Promoted',
                        '2'		=>	'Deleted',
                        '21'	=>	'TC Generated',
                        '22'	=>	'Departed w/o TC',
                        '23'	=>	'Rusticated',
                        '2x'	=>	'Deleted (Other Reasons)',
                        '127'	=>	'Cancelled', // Legacy
    ],
    "student.crons" => ['student-birthday' => 'Student Birthday Message'],
    "student.list-filters" => [
                        "admin"	=>	[
                            'current_session_filter' => "Session/current_session/session-json",
                            'current_class_filter' => "Class/current_class/class-json",
                            'current_section_filter' => "Section/current_section/section-json",
                            'where_you_found_us_filter' => "Source/where_you_found_us/where_you_found_us-json",
                            'status_filter' => "Status/status/student_status-json"
                        ],
                        "portal" => [
                            'current_session_filter' => "Session/current_session/session-json",
                            'current_class_filter' => "Class/current_class/class-json",
                            'current_section_filter' => "Section/current_section/section-json",
                            'where_you_found_us_filter' => "Source/where_you_found_us/where_you_found_us-json",
                            'status_filter' => "Status/status/student_status-json"
                        ]
    ],
    "student.bulk-operations" => [
                        "document:admission-form"			=>	"Print Admission Form",
                        "document:id-card"					=>	"Print ID Card",
                        "document:activity-undertaking"	=>	"Print Activities Undertaking",
                        "document:character-certificate"	=>	"Print Character Certificate",
                        "document:medical-certificate"		=>	"Print Medical Certificate",
                        "document:transfer-certificate"	=>	"Print Transfer Certificate",
                        "document:bonafide-certificate"	=>	"Print Bonafide Certificate",
                        "document:dob-certificate"			=>	"Print DOB Certificate",
                        "document:fee-certificate"			=>	"Print Fee Certificate",
                        "document:exam-form"				=>	"Print Exam Form",
                        "document:admit-card"				=>	"Print Admit Card",
                        "send:email"					=>	"Send Email",
                        "send:sms"						=>	"Send SMS",
                        //"forward-exam-form"			=>	"Forward Exam Form for Submission",
                        "student:promote"					=>	"Promote Class (One or More Student)",
                        "student:promote-all"				=>	"Promote All Class Students at Once",
                        "student:demote"					=>	"Demote Class (One or More Student)",
                        "student:demote-all"				=>	"Demote All Class Students at Once",
                        "student:bulk-discount"		=>	"Bulk Discount",
                        //"relieved-tc-given"				=>	"Relieved/TC Given",
                        "op:remove"						=>	"Delete",
                        "op:restore"					=>	"Restore"
    ],
    "student.default-columns" => [
                        'entry'				=>	['admission_id','student_name', 'father_name', 'phone_number', 'current_class', 'current_section', 'permanent_address', 'tags', 'status'],
                        'list'				=>	['admission_id','student_name', 'father_name', 'phone_number', 'current_class', 'current_section', 'permanent_address', 'tags', 'status'],
                        'detail'			=>	['admission_id','student_name', 'father_name', 'phone_number', 'current_class', 'current_section', 'permanent_address', 'tags', 'status'],
                        'report'			=>	['admission_id','student_name', 'father_name', 'phone_number', 'current_class', 'current_section', 'permanent_address', 'status'],
                        'sample_export'		=>	['sno','student_name', 'father_name', 'phone_number','admission_class','admission_section','admission_session','current_class', 'current_section','current_session','permanent_address'],
                        'selected_columns'	=>	['student_name', 'father_name', 'phone_number','admission_class','admission_section','admission_session','current_class', 'current_section','current_section','permanent_address'],
                        'day-report'		=>	['admission_id', 'student_name', 'father_name', 'phone_number', 'dob', 'status'],
                        'dues-report'		=>	['admission_id', 'student_name', 'father_name', 'phone_number', 'permanent_address', 'dob', 'status']
    ],
    "student.permission-allowed-filters-portal" => [
                        "list"			=>	[[ "admission_id"	=>	'{$login_id}' ]],
                        "profile"		=>	[[ "admission_id"	=>	'{$login_id}' ]],
                        "upload"		=>	[[ "admission_id"	=>	'{$login_id}' ]],
                        "report"		=>	[[ "admission_id"	=>	'{$login_id}' ]],
                        "fee-history"	=>	[[ "admission_id"	=>	'{$login_id}' ]],
                        //"fee-slip"		=>	[[ "admission_id"	=>	'{$login_id}' ]],
    ],
    "student.documents" => [
                        'activity-undertaking'	=> 'Activity Undertaking',
                        'admission-form'		=> 'Admission Form',
                        'admit-card'			=> 'Admit Card',
                        'bonafide-certificate'	=> 'Bonafide Certificate',
                        'dob-certificate'		=> 'DOB Certificate',
                        'character-certificate' => 'Character Certificate',
                        'fee-certificate'		=> 'Fee Certificate',
                        'student-id-card'		=> 'ID Card',
                        'medical-certificate'	=> 'Medical Certificate',
                        'transfer-certificate'	=> 'Transfer Certificate',
                        'fee-structure'			=> 'Fee Structure'
    ],
    'student.list-columns' => [
                        'admission_number',
                        'name',
                        'gender',
                        'phone',
                        'father_name',
                        'category',
                        'status',
    ],

    'student.list-filters' => [
                        'gender',
                        'category',
                        'status',
                        'admission_date',
    ],

    'student.report-columns' => [
                        'admission_number',
                        'admission_date',
                        'name',
                        'gender',
                        'dob',
                        'age',
                        'category',
                        'nationality',
                        'phone',
                        'email',
                        'father_name',
                        'mother_name',
    ],

];
