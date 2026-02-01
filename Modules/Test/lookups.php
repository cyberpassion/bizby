<?php
$pg = 'test';
$commonSettingsRoute = '/settings';

return [

'sidebar-menu' => [
    [
        'title'      => ucfirst($pg),
        'href'       => "/{$pg}",
        'permission' => "{$pg}.access",
        'items'      => [

            /* Single Test */
            [
                'title' => 'Single Test',
                'items' => [
                    [
                        'title'      => 'Create New',
                        'href'       => "/module/{$pg}/single/create",
                        'permission' => "{$pg}.single.create",
                    ],
                    [
                        'title'      => 'View List',
                        'href'       => "/module/{$pg}/single/list",
                        'permission' => "{$pg}.single.view",
                    ],
                    [
                        'title'      => 'View Report',
                        'href'       => "/module/{$pg}/single/report",
                        'permission' => "{$pg}.single.report",
                    ],
                ],
            ],

            /* Package Test */
            [
                'title' => 'Package Test',
                'items' => [
                    [
                        'title'      => 'Create New',
                        'href'       => "/module/{$pg}/package/create",
                        'permission' => "{$pg}.package.create",
                    ],
                    [
                        'title'      => 'View List',
                        'href'       => "/module/{$pg}/package/list",
                        'permission' => "{$pg}.package.view",
                    ],
                    [
                        'title'      => 'View Report',
                        'href'       => "/module/{$pg}/package/report",
                        'permission' => "{$pg}.package.report",
                    ],
                ],
            ],

            /* Pool */
            [
                'title'      => 'Pool',
                'href'       => "/module/{$pg}/pool",
                'permission' => "{$pg}.pool.manage",
            ],

            /* Settings */
            [
                'title'      => 'Settings',
                'href'       => "/module/{$pg}/settings",
                'permission' => "{$pg}.settings.manage",
            ],

            /* Plugins */
            [
                'title' => 'Plugins',
                'items' => [
                    [
                        'title'      => 'View Calendar',
                        'href'       => "/plugin/calendar?module={$pg}",
                        'permission' => "{$pg}.plugin.manage",
                    ],
                ],
            ],
        ],
    ],
],


    'test.crons' => ['test-remindertoexaminees' => 'Test Reminder Notification'],
     'test.list-filters' => [
                        "admin"	=>	[
                            'session' => 'Session/session/session-json',
                            'recipient' => 'Recipient/recipient/recipient_grouped_simplified-json',
                            'status' => 'Status/status/test_status-json',
                            'test_date_filter' => 'Date/date/test_date-json',
    
                        ],
                        "portal" => [
                            'session' => 'Session/session/session-json',
                            'recipient' => 'Recipient/recipient/recipient_grouped_simplified-json',
                            'status' => 'Status/status/test_status-json',
                            'test_date_filter' => 'Date/date/test_date-json',
                        ]
    ],
    'test.bulk-operations' => [
                        "view:detail"			=>	"View Detail",
                        "document:results"		=>	"View Results",
                        "op:remove"				=>	"Delete",
                        "op:restore"			=>	"Restore"
    ],
    'test.default-columns' => [
                        'entry'				=>	['test_id', 'package_name', 'test_name', 'test_date', 'start_time', 'end_time', 'total_time', 'question_count', 'language_question_status', 'all_recipients'. 'tags', 'status'],
                        'list'				=>	['test_id', 'package_name', 'test_name', 'test_date', 'start_time', 'end_time', 'total_time', 'question_count', 'language_question_status', 'all_recipients', 'tags', 'status'],
                        'detail'			=>	['test_id', 'package_name', 'test_name', 'test_date', 'start_time', 'end_time', 'total_time', 'question_count', 'language_question_status', 'all_recipients', 'tags', 'status'],
                        'report'			=>	['test_id', 'package_name', 'test_name', 'test_date', 'start_time', 'end_time', 'total_time', 'question_count', 'language_question_status', 'all_recipients', 'tags', 'status'],
                        'sample_export'		=>	['sno', 'test_name', 'test_date', 'start_time', 'end_time', 'total_time', 'question_count', 'language_question_status'],
                        'selected_columns'	=>	['test_name', 'test_date', 'start_time', 'end_time', 'total_time', 'question_count', 'language_question_status']
    ],
    'test.documents' => ['question-paper'	=> 'Question Paper'],
    'test.list-columns' => [
                        'id',
                        'test_name',
                        'test_package',
                        'test_set',
                        'session',
                        'recipient',
                        'test_date',
                        'total_time',
                        'question_count',
                        'status',
    ],

    'test.list-filters' => [
                        'test_package',
                        'test_set',
                        'test_name',
                        'session',
                        'recipient',
                        'test_date',
                        'status',
    ],

    'test.report-columns' => [
                       'id',
                       'test_package',
                       'test_set',
                       'test_name',
                       'test_language',
                       'test_format',
                       'test_structure',
                       'test_marking_format',
                       'question_source',
                       'question_count',
                       'test_date',
                       'total_time',
                       'start_time',
                       'end_time',
                       'is_strict_timing',
                       'max_attempts_allowed',
                       'test_interface',
                       'instructions',
                       'instructions_translated',
                       'created_for',
                       'response',
    ],






    'test-message_text' => [
                        "autogenerated_test_from_pool|true"	=>	"Questions Added from Pool",
                        "autogenerated_test_from_pool|false"=>	"Failed to Add Questions from Pool"
    ],
    'communicationTemplate-test' => [
                        "test_entry_new_sms"		=>	"New Test Entry SMS",
                        "test_entry_new_whatsapp"	=>	"New Test Entry Whatsapp",
                        "test_entry_new_email"		=>	"New Test Entry Email",
    ],
    'columnNameMapping-test' => [
                        'ptr'			=>	'SNo',
                        'package_id'	=>	'P/ID',
                        'package_name'	=>	'P/Name',
                        'all_package_items'		=>	'All/Items',
                        'active_package_items'	=>	'Items',
                        'draft_package_items'	=>	'Items',
                        'active_subscriptions'	=>	'Active Subs',
                        'inactive_subscriptions'=>	'Lost Subs',
                        'test_id'		=>	'ID',
                        'date'			=>	'Date',
                        'total_time'	=>	'Dur (mts)',
                        'test_name'		=>	'Name',
                        'test_date'		=>	'Date',
                        'start_time'	=>	'Start',
                        'end_time'		=>	'End',
                        'question_count' =>	'Total Qns',
                        'language_question_status'	=>	'Questions',
                        'student_name'	=>	'S/Name',
                        'current_class'	=>	'Class',
                        'current_section' =>	'Section',
                        'current_session' =>	'Session'
    ],
    'mandatoryOptionsBeforeUsing-test' => [
                        'missing_option'	=>	[
                            'Test Category/Subjects'	=>	'test_category-json',
                            'Test Levels'				=>	'test_level-json'
                        ]
    ],
    'moduleTable-test' => [
                        "cyp_term",
                        "cyp_activity",
                        "cyp_advancedinfo",
                        "cyp_allotment",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_upload",
                        "cyp_notification",
                        "cyp_message",
                        "cyp_test",
                        "cyp_test_question_multiplechoice",
                        "cyp_test_question_pool_multiplechoice",
                        "cyp_test_result"
    ],
    'mandatoryFields-test-package-entry-update' => ['package_name','package_information'],

    'mandatoryFields-test-entry-update' => ['test_name','question_count','total_time'],

    'dateFields-test-entry-update' => [],

    'additionalFields-test-entry-update' => [],

    'listFilters-test-package-list' => [
                        "admin"	=>	[
                            'recipient' => 'Recipient/recipient/recipient_grouped_simplified-json',
                            'status' => 'Status/status/test_package_status-json',
                        ],
                        "portal" => [
                            'recipient' => 'Recipient/recipient/recipient_grouped_simplified-json',
                            'status' => 'Status/status/test_package_status-json',
                        ]
    ],
    
    'listFilters-test-default' => [
                        "admin"	=>	[
                            'language' => 'Language/language/test_pool_language-json',
                            'category' => 'Category/category/test_pool_category-json',
                            'tag' => 'Tag/tag/test_pool_tag-json',
                            'level' => 'Level/level/test_pool_level-json',
                            'limit' => 'Limit/limit/test_pool_limit-json',
                        ],
                        "portal" => [
                            'language' => 'Language/language/test_pool_language-json',
                            'category' => 'Category/category/test_pool_category-json',
                            'tag' => 'Tag/tag/test_pool_tag-json',
                            'level' => 'Level/level/test_pool_level-json',
                            'limit' => 'Limit/limit/test_pool_limit-json',
                        ]
    ],

    'test-report-by-attempt-type' => ['attempted'=>'ATTEMPTED','not-attempted'=>'NOT-ATTEMPED'],

    'test-sortby' => ["student_name"=>"Name","percentage"=>"Rank"],

    'sort-test-results-by' => [
                        'rank'			=>	'RANK',
                        'student_name'	=>	'STUDENT NAME',
                        'correct'		=>	'CORRECT QUESTIONS',
                        'wrong'			=>	'WRONG QUESTIONS',
                        'skipped'		=>	'SKIPPED QUESTION'
    ],
    'sort-test-package-by' => [
                        'items'					=>	'Test Items',
                        'most_subscribed'		=>	'Most Subscribed'
    ],
    'test-format' => ["multiple-choice"=>"Multiple-Choice","multiple-choice-from-pool"=>"Multiple-Choice From Pool"],

    'test-interface' => ["portal"=>"Student Portal"],

    'test-question-source' => [
                        "create-set"						=> "No Source, Create Set",
                        "autogenerate-set-from-pool"		=> "Generate From Questions Pool"
    ],
    'test-pool-limit' => ['25','50','75','100'],

    'test-offline-sheet-format' => ['offline-sheet-inline'=>'Inline Questions','offline-sheet-2cols'=>'2cols Questions'],

    'subscriptionEntity-test' => ['test/package-entry']

];
