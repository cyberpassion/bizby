<?php
$pg = 'employee';

return [

    // -------------------------------
    // Communication Templates
    // -------------------------------
    "communicationTemplate-employee" => [
        "employee_entry_new_sms"        => "New Employee Entry SMS",
        "employee_entry_new_whatsapp"   => "New Employee Entry Whatsapp",
        "employee_entry_new_email"      => "New Employee Entry Email",
        "employee_salary_new_sms"       => "New Employee Salary SMS",
        "employee_salary_new_whatsapp"  => "New Employee Salary Whatsapp",
        "employee_salary_new_email"     => "New Employee Salary Email",
        "employee_birthday_new_sms"     => "Employee Birthday SMS",
        "employee_birthday_new_whatsapp"=> "Employee Birthday Whatsapp",
        "employee_birthday_new_email"   => "Employee Birthday Email",
    ],

    // -------------------------------
    // Column Name Mapping
    // -------------------------------
    "columnNameMapping-employee" => [
        'employee_id'                    => 'ID',
        'employee_name'                  => 'Name',
        'employee_type'                  => 'Type',
        'designation'                    => 'Designation',
        'educational_qualification'      => 'Edu. Qual.',
        'professional_qualification'     => 'Prof. Qual.',
        'teaching_exam_qualified'        => 'Exam Qual.',
        'date_of_joining'                => 'Joining Date',
        'secondary_passing_roll_no'      => 'School Passing Roll',
        'secondary_passing_year'         => 'School Passing Year',
        'teaching_subjects'              => 'Subjects',
    ],

    // -------------------------------
    // Menu
    // -------------------------------
    "menuItem-employee" => [
        "admin" => [
            "parent" => [
                "Employee" => [
                    "/employee/home",
                    "sidebar-list-employee"
                ]
            ],
            "child" => [
                "employee" => [
                    "Add New"       => "/employee/entry/new",
                    "View List"     => "/employee",
                    "Settings"      => "/employee/settings",
                    "Report"        => "/employee/report",
                    "Bulk Operation"=> "/employee/bulk-operation"
                ]
            ],
            "child-2" => [
                "employee-settings" => [
                    "Settings"          => "/employee/settings",
                    "Salary Settings"   => "/employee/salary-settings"
                ],
                "employee-report" => [
                    "Report"            => "/employee/report",
                    "Salary Report"     => "/employee/salary-report"
                ]
            ]
        ],
        "portal" => [
            "parent" => [
                "Employee" => [
                    "/employee/home",
                    "sidebar-list-employee"
                ]
            ],
            "child" => [
                "employee" => [
                    "My Salary" => "/employee/salary-history"
                ]
            ]
        ]
    ],

    // -------------------------------
    // Page Structure
    // -------------------------------
    "pgStructure-employee" => [
        "employee" => [
            "forms/form" => [
                "entry", "salary-entry", "salary-settings", "settings",
                "advanced-info-entry", "report", "salary-report",
                "bulk-operation", "upload", "permission"
            ],
            "lists/list" => ["list"],
            "views/view" => [
                "home", "document", "profile", "detail", "salary-slip",
                "history", "salary-history"
            ]
        ]
    ],

    // -------------------------------
    // Mandatory Options
    // -------------------------------
    "mandatoryOptionsBeforeUsing-employee" => [
        "missing_option" => [
            "Employee Types" => "employee_type-json"
        ]
    ],

    // -------------------------------
    // Module Tables
    // -------------------------------
    "moduleTable-employee" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_employee"
    ],

    // -------------------------------
    // Default Columns
    // -------------------------------
    "defaultColumns-employee" => [
        "entry"     => ['employee_id','employee_name','employee_type','designation','permanent_address','dob','tags','status'],
        "list"      => ['employee_id','employee_name','employee_type','designation','permanent_address','dob','tags','status'],
        "detail"    => ['employee_id','employee_name','employee_type','designation','permanent_address','dob','tags','status'],
        "report"    => ['employee_id','employee_name','employee_type','designation','permanent_address','dob','tags','status'],
        "sample_export" => ['sno','employee_name','employee_type','designation','permanent_address','dob','phone_number','email_id'],
        "selected_columns" => ['employee_name','employee_type','designation','permanent_address','dob','phone_number','email_id']
    ],

    // -------------------------------
    // Interactive Entity
    // -------------------------------
    "interactiveEntity-employee" => ["employee"],

    // -------------------------------
    // Cron List
    // -------------------------------
    "cronList-employee" => [
        "employee-birthday" => "Employee Birthday Message"
    ],

    // -------------------------------
    // Mandatory Fields
    // -------------------------------
    "mandatoryFields-employee_entry" => ['employee_name','phone_number'],

    // -------------------------------
    // Date Fields
    // -------------------------------
    "dateFields-employee_entry" => ['dob','date','date_of_joining','date_of_relieving'],

    // -------------------------------
    // Additional Fields
    // -------------------------------
    "additionalFields-employee_entry" => ['employee_additional_field'],

    // -------------------------------
    // JSON Fields
    // -------------------------------
    "jsonFields-employee_entry" => [
        'qualifications','job_responsibility','teaching_subjects',
        'teaching_classes','announcement_permission','attendance_permission'
    ],

    // -------------------------------
    // List Filters
    // -------------------------------
    "listFilters-employee_entry" => [
        "admin" => [
            'employee_type_filter one' => "Employee Type/employee_type/employee_type-json",
            'sort status' => "Status/status/status-json"
        ],
        "portal" => [
            'employee_type_filter one' => "Employee Type/employee_type/employee_type-json",
            'sort status' => "Status/status/status-json"
        ]
    ],

    // -------------------------------
    // Single Entry Options
    // -------------------------------
    "listFilters-employee_entry_update" => [
        "admin" => [
            "employee" => [
                "View Profile" => "employee/profile",
                "Edit"         => "employee/entry/update",
                "Print"        => "employee/document",
                "Upload"       => "employee/upload",
                "View Details" => "employee/detail",
                "View History" => "employee/history",
                "Download Docs"=> "employee/download-zip"
            ],
            "salary" => [
                "Add Salary"      => "employee/salary-entry",
                "View History"    => "employee/salary-history"
            ]
        ]
    ],

    // -------------------------------
    // Report Filters
    // -------------------------------
    "listFilters-employee_employee-report" => [
        "admin" => [
            "report_type_filter" => "Report Type/report_type/employee_type-json"
        ],
        "portal" => [
            "report_type_filter" => "Report Type/report_type/employee_type-json"
        ]
    ],

    // -------------------------------
    // Locked Fields
    // -------------------------------
    "lockedFields-employee_entry_update" => "employee_form_locked_column-json",

    // -------------------------------
    // Permission (Admin)
    // -------------------------------
    "permissionAdmin-employee" => [
        "restricted" => [
            "2" => [["pg"=>"employee","sub_pg"=>"settings"]],
            "3" => [["pg"=>"employee","sub_pg"=>"settings"]]
        ],
        "allowed" => []
    ],

    // -------------------------------
    // Permission (Portal)
    // -------------------------------
    "permissionPortal-employee" => [
        "restricted" => [],
        "allowed" => [
            ["pg"=>"employee","sub_pg"=>"home"],
            ["pg"=>"employee","sub_pg"=>"profile"],
            ["pg"=>"employee","sub_pg"=>"salary-history"],
            ["pg"=>"employee","sub_pg"=>"document"],
            ["pg"=>"employee","sub_pg"=>"history"],
            ["pg"=>"employee","sub_pg"=>"report"],
            ["pg"=>"employee","sub_pg"=>"employee-report"]
        ]
    ],

    // -------------------------------
    // Allowed Portal Filters
    // -------------------------------
    "permissionAllowedFiltersPortal-employee" => [
        "profile" => [["employee_id" => '{$login_id}']],
        "list"    => [["employee_id" => '{$login_id}']],
        "report"  => [["employee_id" => '{$login_id}']]
    ],

    // -------------------------------
    // Prefills
    // -------------------------------
    "formPrefills-employee_entry" => [
        "columns" => [
            "product"       => "default_product",
            "contact_mode"  => "default_contact_mode",
            "state"         => "default_indian_state"
        ],
        "groups" => [
            "current_date" => ["contact_date"]
        ]
    ],

    // -------------------------------
    // Search Columns
    // -------------------------------
    "search_column-json" => ["employee_name","phone_number"],

    // -------------------------------
    // Job Responsibility
    // -------------------------------
    "job_responsibility-json" => ["HR","UPDATE SALARY"],

    // -------------------------------
    // Status
    // -------------------------------
    "employee_status-json" => [
        "1"  => "Active",
        "11" => "Draft",
        "2"  => "Deleted",
        "21" => "Departed"
    ],

    // -------------------------------
    // Employee Documents
    // -------------------------------
    "employee_document-json" => [
        "offer-letter"              => "Offer Letter",
        "employer-bond"             => "Employer Bond",
        "appointment-letter"        => "Appointment Letter",
        "salary-increment-letter"   => "Salary Increment Letter",
        "promotion-letter"          => "Promotion Letter",
        "relieving-letter"          => "Relieving Letter",
        "experience-certificate"    => "Experience Certificate",
        "internship-certificate"    => "Internship Certificate",
        "employee-id-card"          => "ID Card"
    ],

    // -------------------------------
    // Bulk Operations
    // -------------------------------
    "employee_bulk_operation-list" => [
        "document:offer-letter"             => "Print Offer Letter",
        "document:employer-bond"           => "Print Employer Bond",
        "document:appointment-letter"      => "Print Appointment Letter",
        "document:salary-increment-letter" => "Print Salary Increment Letter",
        "document:relieving-letter"        => "Print Relieving Letter",
        "document:experience-certificate"  => "Print Experience Certificate",
        "document:internship-certificate"  => "Print Internship Certificate",
        "document:employee-id-card"        => "Print ID Card",
        "send:email"                       => "Send Email",
        "send:sms"                         => "Send SMS",
        "op:remove"                        => "Delete",
        "op:restore"                       => "Restore"
    ],

    // -------------------------------
    // Sort Options
    // -------------------------------
    "sort_employee_results_by-list" => [
        "employee_name" => "EMPLOYEE NAME",
        "father_name"   => "FATHER NAME",
        "employee_id"   => "EMPLOYEE ID",
        "dob"           => "DATE OF BIRTH"
    ],

    // -------------------------------
    // Note Types
    // -------------------------------
    "employee_note_type-json" => [
        "performance" => "Performance",
        "other"       => "Other"
    ],

];
