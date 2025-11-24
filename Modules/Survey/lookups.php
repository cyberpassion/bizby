<?php

$pg = 'survey';

return [
    // Communication Templates
    "communicationTemplate-survey" => [
        "survey_entry_new_sms"       => "New Survey Entry SMS",
        "survey_entry_new_whatsapp"  => "New Survey Entry Whatsapp",
        "survey_entry_new_email"     => "New Survey Entry Email",
    ],

    // Column Name Mapping
    "columnNameMapping-survey" => [
        'ptr'       => 'SNo',
        'survey_id' => 'ID',
        'date'      => 'Date',
        'added_by'  => 'Added By',
        'question'  => 'Question',
        'recipient' => 'Recipient',
        'responses' => 'Responses'
    ],

    // Default Columns
    "defaultColumns-survey" => [
        'entry'             => ['survey_id', 'date', 'category', 'question', 'all_recipients', 'responses', 'added_by', 'tags', 'status'],
        'list'              => ['survey_id', 'date', 'category', 'question', 'all_recipients', 'responses', 'added_by', 'tags', 'status'],
        'detail'            => ['survey_id', 'date', 'category', 'question', 'all_recipients', 'responses', 'added_by', 'tags', 'status'],
        'report'            => ['survey_id', 'date', 'category', 'question', 'all_recipients', 'responses', 'added_by', 'tags', 'status'],
        'sample_export'     => ['sno', 'category', 'question', 'recipient', 'responses', 'added_by'],
        'selected_columns'  => ['category', 'question', 'recipient', 'responses', 'added_by']
    ],

    // Module Tables
    "moduleTable-survey" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_survey",
        "cyp_surveyresponse"
    ],

    // Mandatory Fields
    "mandatoryFields-survey_entry" => ['question','option_1','option_2','option_3','option_4','end_date','recipients'],

    // Date Fields
    "dateFields-survey_entry" => ['date','end_date'],

    // Additional Fields
    "additionalFields-survey_entry" => [],

    // Cron List
    "cronList-survey" => ['survey-notification' => 'Survey Notification'],

    // List Filters
    "listFilters-survey_entry" => [
        "admin" => [
            'date_filter'                  => "Date/date/survey_date-json",
            'survey_category_filter one'   => "Category/survey_type/survey_category-json",
            'survey_status_filter one'     => "Status/status/status-json"
        ],
        "portal" => [
            'date_filter'                  => "Date/date/survey_date-json",
            'survey_category_filter one'   => "Category/survey_type/survey_category-json",
            'survey_status_filter one'     => "Status/status/status-json"
        ]
    ],

    // List Options (Admin & Portal)
    "listFilters-survey_entry_update" => [
        'admin' => [
            $pg => [
                'Edit'             => "{$pg}/entry/update",
                'Attempt Response' => "{$pg}/response",
                'View Responses'   => "{$pg}/single",
                'Upload'           => "{$pg}/upload",
                'View Details'     => "{$pg}/detail",
                'View History'     => "{$pg}/history",
            ]
        ],
        'portal' => [
            $pg => [
                'View Details' => "{$pg}/detail",
                'Add Response' => "{$pg}/response",
            ]
        ]
    ],

    // Permission Templates (simplified)
    "permissionAdmin-survey" => [
        'restricted' => [
            '2' => [['pg' => $pg, 'sub_pg' => 'settings']],
            '3' => [['pg' => $pg, 'sub_pg' => 'settings']]
        ],
        'allowed' => []
    ],

    "permissionPortal-survey" => [
        'restricted' => [],
        'allowed' => [
            ['pg' => $pg, 'sub_pg' => 'home'],
            ['pg' => $pg, 'sub_pg' => 'detail'],
            ['pg' => $pg, 'sub_pg' => 'list'],
            ['pg' => $pg, 'sub_pg' => 'response'],
            ['pg' => $pg, 'sub_pg' => 'report'],
            ['pg' => $pg, 'sub_pg' => "{$pg}-report"],
        ]
    ],

    // Allowed Filters for Portal
    // "permissionAllowedFiltersPortal-survey" => [
    //     "entry"  => [['recipient' => '{$login_type}-{$byline}']],
    //     "list"   => [['recipient' => '{$login_type}-{$byline}']],
    //     "report" => [['recipient' => '{$login_type}-{$byline}']]
    // ],

    // Form Prefills
    "formPrefills-survey_entry" => [
        "columns" => [
            'product'      => 'default_product',
            'contact_mode' => 'default_contact_mode',
            'state'        => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    // Survey Bulk Operations
    "survey_bulk_operation-list" => [
        "view:detail"    => "View Detail",
        "view:responses" => "View Responses",
        "op:remove"      => "Delete",
        "op:restore"     => "Restore"
    ],

    // Placeholder JSON arrays
    "survey_date-json"   => [],
    "survey_status-json" => [],

    // pgStructure (Forms, Lists, Views)
    "pgStructure-survey" => [
        'survey' => [
            'forms/form'   => ['entry', 'response', 'settings', 'report'],
            'lists/list'   => ['list'],
            'views/view'   => ['home', 'document', 'profile', 'single', 'detail', 'history']
        ]
    ],

    // Mandatory Options Before Using Module
    "mandatoryOptionsBeforeUsing-survey" => [
        'missing_option' => [
            'Survey Category' => 'survey_category-json'
        ]
    ]
];
