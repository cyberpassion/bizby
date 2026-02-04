<?php
$pg = 'survey';

return [

    'survey.crons' => [
        'survey-notification' => 'Survey Notification'
    ],

    'survey.list-filters' => [
        "admin" => [
            'date_filter'                 => "Date/date/survey_date-json",
            'survey_category_filter one'  => "Category/survey_type/survey_category-json",
            'survey_status_filter one'    => "Status/status/status-json"
        ],
        "portal" => [
            'date_filter'                 => "Date/date/survey_date-json",
            'survey_category_filter one'  => "Category/survey_type/survey_category-json",
            'survey_status_filter one'    => "Status/status/status-json"
        ]
    ],

    'survey.bulk-operations' => [
        "view:detail"     => "View Detail",
        "view:responses"  => "View Responses",
        "op:remove"       => "Delete",
        "op:restore"      => "Restore"
    ],

    'survey.default-columns' => [
        'entry'            => ['survey_id','date','category','question','all_recipients','responses','added_by','tags','status'],
        'list'             => ['survey_id','date','category','question','all_recipients','responses','added_by','tags','status'],
        'detail'           => ['survey_id','date','category','question','all_recipients','responses','added_by','tags','status'],
        'report'           => ['survey_id','date','category','question','all_recipients','responses','added_by','tags','status'],
        'sample_export'    => ['sno','category','question','recipient','responses','added_by'],
        'selected_columns' => ['category','question','recipient','responses','added_by']
    ],

    'survey.permission-allowed-filters-portal' => [
        "entry"  => [["recipient" => '{$login_type}-{$byline}']],
        "list"   => [["recipient" => '{$login_type}-{$byline}']],
        "report" => [["recipient" => '{$login_type}-{$byline}']]
    ],

    'survey.list-columns' => [
        'survey_id',
        'category',
        'recipient',
        'session',
        'month',
        'end_date',
        'status',
    ],

    'survey.report-columns' => [
        'survey_id',
        'category',
        'recipient',
        'session',
        'month',
        'question',
        'option_1','option_1_responses',
        'option_2','option_2_responses',
        'option_3','option_3_responses',
        'option_4','option_4_responses',
    ],

    'survey.survey-categories' => [
        'default' => 'Default',
    ],

    'communicationTemplate-survey' => [
        "survey_entry_new_sms"       => "New Survey Entry SMS",
        "survey_entry_new_whatsapp"  => "New Survey Entry Whatsapp",
        "survey_entry_new_email"     => "New Survey Entry Email",
    ],

    'columnNameMapping-survey' => [
        'ptr'        => 'SNo',
        'survey_id'  => 'ID',
        'date'       => 'Date',
        'added_by'   => 'Added By',
        'question'   => 'Question',
        'recipient'  => 'Recipient',
        'responses'  => 'Responses'
    ],

    'mandatoryOptionsBeforeUsing-survey' => [
        'missing_option' => [
            'Survey Category' => 'survey_category-json'
        ]
    ],

    'moduleTable-survey' => [
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

    'mandatoryFields-survey-entry-update' => [
        'question','option_1','option_2','option_3','option_4','end_date','recipients'
    ],

    'dateFields-survey-entry-update' => ['date','end_date'],

    'additionalFields-survey-entry-update' => [],

    'formPrefills-survey-entry-new' => [
        "columns" => [
            'product'       => 'default_product',
            'contact_mode'  => 'default_contact_mode',
            'state'         => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

];
