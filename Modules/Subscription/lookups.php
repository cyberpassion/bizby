<?php
$pg = 'subscription';
$commonSettingsRoute = '/settings';

return [
	'menuItem-subscription' => [
    'admin' => [
        'parent' => [
            $pg => '#',
        ],
        'child' => [
            $pg => [
                ['Add New'   => "/{$pg}/create"],
                ['View List' => "/{$pg}/list"],
                ['Report'    => "/{$pg}/report"],
                ['Settings'  => "/{$pg}/settings"],
                [
                    'Plugin' => [
                        ['View Calendar' => "/{$pg}/calendar"],
                    ]
                ],
            ],
        ],
    ],
],

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
                    ['title' => 'View Calendar', 'href' => "/module/{$pg}/calendar"],
                ]
            ],
        ],
    ],
],
    'communicationTemplate-subscription' => [
                        "subscription_entry_new_sms"				=>	"New Subscription Entry SMS",
                        "subscription_entry_new_whatsapp"			=>	"New Subscription Entry Whatsapp",
                        "subscription_entry_new_email"				=>	"New Subscription Entry Email",
                        "subscription_renewalreminder_new_sms"		=>	"New Subscription Renewal Reminder SMS",
                        "subscription_renewalreminder_new_whatsapp"	=>	"New Subscription Renewal Reminder Whatsapp",
                        "subscription_renewalreminder_new_email"	=>	"New Subscription Renewal Reminder Email",
    ],
    'columnNameMapping-subscription' => [
                        'ptr'					=>	'SNo',
                        'date'					=>	'Date',
                        'user_info'				=>	'User Info',
                        'plan_name'				=>	'Plan',
                        'subscription_id'		=>	'ID',
                        'subscription_plan_id'	=>	'Plan ID',
                        'subscription_plan'		=>	'Plan',
                        'plan_category'			=>	'Category',
                        'plan_pricing'			=>	'Pricing',
                        'plan_duration'			=>	'Duration (d)',
                        'plan_description'		=>	'Description',
                        'plan_type'				=>	'Plan Type',
                        'start_date'			=>	'Start Date',
                        'end_date'				=>	'End Date',
                        'remaining_days'		=>	'Rem. Days',
                        'estimated_amount'		=>	'Estimated Amount',
                        'subscription_category'	=>	'Category',
                        'subscription_type'		=>	'Type'
    ],
    'defaultColumns-subscription' => [
                        'entry'				=>	['subscription_plan', 'start_date', 'end_date', 'remaining_days', 'estimated_amount', 'status', 'options'],
                        'list'				=>	['subscription_plan', 'start_date', 'end_date', 'remaining_days', 'estimated_amount', 'status', 'options'],
                        'detail'			=>	['subscription_plan', 'start_date', 'end_date', 'remaining_days', 'estimated_amount', 'status', 'options'],
                        'report'			=>	['subscription_plan', 'start_date', 'end_date', 'remaining_days', 'estimated_amount', 'status', 'options'],
                        'sample_export'		=>	['sno','subscription_plan', 'start_date', 'end_date', 'remaining_days', 'estimated_amount'],
                        'selected_columns'	=>	['subscription_plan', 'start_date', 'end_date', 'remaining_days', 'estimated_amount'],
                        'udx-available-addons'	=>	['subscription_plan_id','plan_name','plan_type','plan_pricing','options'],
    ],
    'mandatoryOptionsBeforeUsing-subscription' => [
                        'missing_option'	=>	[]
    ],
    'moduleTable-subscription' => [
                        "cyp_term",
                        "cyp_activity",
                        "cyp_cash",
                        "cyp_option",
                        "cyp_announcement",
                        "cyp_subscription_plan",
                        "cyp_subscription",
                        "cyp_coupon",
                        "cyp_notification"
    ],
    'mandatoryFields-subscription_entry_update' => [],

    'dateFields-subscription_entry_update' => ['start_date','end_date'],

    'additionalFields-subscription_entry_update' => [],

    'mandatoryFields-subscription_plan-entry_update' => ["plan_name","plan_pricing"],

    'dateFields-subscription_plan-entry_update' => [],

    'additionalFields-subscription_plan-entry_update' => [],

    'listFilters-subscription_list' => [
                        "admin"	=>	[
                            'nextdate' 						=> "Next Date/range-next_date/filter_date_range-json",
                            'subscription_plan'				=> "Plan/subscription_plan_id/subscription_plan-json",
                            'subscription_plan_type'		=> "Plan Type/plan_type/subscription_plan_type-json",
                            'subsciption_status_filter'		=> "Status/status/status-json"
                        ],
                        "portal" => [
                            'nextdate' 						=> "Next Date/range-next_date/filter_date_range-json",
                            'subscription_plan'				=> "Plan/subscription_plan_id/subscription_plan-json",
                            'subscription_plan_type'		=> "Plan Type/plan_type/subscription_plan_type-json",
                            'subsciption_status_filter'		=> "Status/status/status-json"
                        ]
    ],
    'listFilters-subscription_plan-list' => [
                        "admin"	=>	[
                            'subscription_plan_type'		=> "Plan Type/plan_type/subscription_plan_type-json",
                            'subsciption_status_filter'		=> "Status/status/status-json"
                        ],
                        "portal" => [
                            'subscription_plan_type'		=> "Plan Type/plan_type/subscription_plan_type-json",
                            'subsciption_status_filter'		=> "Status/status/status-json"
                        ]
    ],
    'subscription_plan_duration-json' => [
                        '365'	=>  'Yearly',
                        '30'	=>  'Monthly'
    ],
    'subscription_plan_type-json' => [
                        'standalone'	=>	'Standalone',
                        'addon'			=>	'Addon'
    ],
    'subscription_status-json' => [
                        1	=>	'Active',
                        2	=>	'Suspended'
    ],
    'subscription_report_type-json' => [
                        "plan"			=>	"All Subscription List",
                        "purchases"		=>	"Subscription Purchases"
    ],
    'subscription_bulk_operation-list' => [
                        "op:remove"				=>	"Delete",
                        "op:restore"			=>	"Restore"
    ]
];
