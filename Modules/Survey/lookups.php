<?php
$pg = 'survey';
$commonSettingsRoute = '/settings';

return [

'sidebar-menu' => [
    [
        'title' => ucfirst($pg),
        'href'  => "/{$pg}",
        'items' => [
            ['title' => 'Home',      'href' => "/module/{$pg}/home"],
            ['title' => 'Add New',   'href' => "/module/{$pg}/new"],
            ['title' => 'View List', 'href' => "/module/{$pg}/list"],
            ['title' => 'Report',    'href' => "/module/{$pg}/report"],
            ['title' => 'Settings',  'href' => "/module/{$pg}/settings"],
            [
                'title' => 'Plugin',
                'items' => [
                    ['title' => 'View Calendar', 'href' => "/plugin/calendar?module={$pg}"],
                ]
            ],
        ],
    ],
],
    'communicationTemplate-survey' => [
                        "survey_entry_new_sms"		    =>	"New Survey Entry SMS",
                        "survey_entry_new_whatsapp"    	=>	"New Survey Entry Whatsapp",
                        "survey_entry_new_email"		=>	"New Survey Entry Email",
    ],
    'columnNameMapping-survey' => [
                        'ptr'			=>	'SNo',
                        'survey_id'		=>	'ID',
                        'date'			=>	'Date',
                        'added_by'		=>	'Added By',
                        'question'		=>	'Question',
                        'recipient'		=>	'Recipient',
                        'responses'		=>	'Responses'
    ],
    'mandatoryOptionsBeforeUsing-survey' => [
                        'missing_option'	=>	[
                            'Survey Category'	=>	'survey_category-json'
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
    'defaultColumns-survey' => [
                        'entry'				=>	['survey_id', 'date', 'category', 'question', 'all_recipients', 'responses', 'added_by','tags', 'status'],
                        'list'				=>	['survey_id', 'date', 'category', 'question', 'all_recipients', 'responses', 'added_by','tags', 'status'],
                        'detail'			=>	['survey_id', 'date', 'category', 'question', 'all_recipients', 'responses', 'added_by','tags', 'status'],
                        'report'			=>	['survey_id', 'date', 'category', 'question', 'all_recipients', 'responses', 'added_by','tags', 'status'],
                        'sample_export'		=>	['sno', 'category', 'question', 'recipient', 'responses', 'added_by'],
                        'selected_columns'	=>	['category', 'question', 'recipient', 'responses', 'added_by']
    ],
    'cronList-survey' => ['survey-notification' => 'Survey Notification'],

    'mandatoryFields-survey-entry-update' => ['question','option_1','option_2','option_3','option_4','end_date','recipients'],

    'dateFields-survey-entry-update' => ['date','end_date'],

    'additionalFields-survey-entry-update' => [],

    'listFilters-survey-list' => [
                        "admin"	=>	[
                            'date_filter'					=> "Date/date/survey_date-json",
                            'survey_category_filter one'	=> "Category/survey_type/survey_category-json",
                            'survey_status_filter one'		=> "Status/status/status-json"
                        ],
                        "portal" => [
                            'date_filter'					=> "Date/date/survey_date-json",
                               'survey_category_filter one'	=> "Category/survey_type/survey_category-json",
                            'survey_status_filter one'		=> "Status/status/status-json"
                        ]
    ],
    'permissionAllowedFiltersPortal-survey' => [
                        "entry"		=>	[["recipient"	=>	'{$login_type}-{$byline}']],
                        "list"		=>	[["recipient"	=>	'{$login_type}-{$byline}']],
                        "report"	=>	[["recipient"	=>	'{$login_type}-{$byline}']]
    ],
    'formPrefills-survey-entry-new' => [
                        "columns"	=>	[
                            'product'		=>	'default_product',
                            'contact_mode'	=>	'default_contact_mode',
                            'state'			=>	'default_indian_state'
                        ],
                        "groups"	=>	[
                            'current_date'	=>	['contact_date']
                        ]
    ],
    'survey-bulk-operation-list' => [
                        "view:detail"		=>	"View Detail",
                        "view:responses"	=>	"View Responses",
                        "op:remove"			=>	"Delete",
                        "op:restore"		=>	"Restore"
    ]

];
