<?php
$pg = 'admin';

return [

    'communicationTemplate-admin' => [
        "client_entry_new_sms"                    => "Client Entry SMS",
        "client_entry_new_whatsapp"              => "Client Entry Whatsapp",
        "client_entry_new_email"                 => "Client Entry Email",
        "client_entry_update_sms"                => "Client Entry Update SMS",
        "client_entry_update_whatsapp"           => "Client Entry Update Whatsapp",
        "client_entry_update_email"              => "Client Entry Update Email",
        "client_scheduleddeletion_new_sms"       => "Client Entry Scheduled Deletion SMS",
        "client_scheduleddeletion_new_whatsapp"  => "Client Entry Scheduled Deletion Whatsapp",
        "client_scheduleddeletion_new_email"     => "Client Entry Scheduled Deletion Email"
    ],

    'menuItem-admin' => [
        "admin"     => [],
        "portal"    => []
    ],

    'pgStructure-admin' => [
        "admin" => [
            'forms/form' => ['settings', 'plan-entry', 'doclinks-entry']
        ],
        "client" => [
            'forms/form' => ['entry','report','doclinks-entry','upload','settings'],
            'lists/list' => ['list','user-list','activity-list'],
            'views/view' => ['profile','configure','activity-detail','db-overview']
        ]
    ],

    'columnNameMapping-client' => [
        'ptr'                      => 'SNo',
        'date'                     => 'Date',
        'client_id'                => 'ID',
        'client_official_name'     => 'Name',
        'client_official_address'  => 'Address',
        'client_official_email'    => 'Email',
        'client_official_phone'    => 'Phone',
        'sale_by'                  => 'Sold By'
    ],

    'mandatoryFields-client_entry' => [
        'subscription_plan_id',
        'client_official_name',
        'client_official_address',
        'client_official_email',
        'client_official_phone'
    ],

    'mandatoryFields-client_renewal-entry' => [
        'renewal_key'
    ],

    'dateFields-client_entry' => [],
    'dateFields-client_renewal-entry' => [],

    'additionalFields-client_entry' => [],
    'additionalFields-client_renewal-entry' => [],

    'listFilters-client_entry' => [
        "admin" => [
            'client_module_filter'         => "Module/parent_subscription_id/subscription_plan-json",
            'client_filter'                => "Client/client_id/client-json",
            'client_status_filter'         => "Status/status/client_status-json",
            'client_renewal_status_filter' => "Renewal Status/renewal_status/client_renewal_status-json"
        ],
        "portal" => [
            'client_module_filter'         => "Module/parent_subscription_id/subscription_plan-json",
            'client_filter'                => "Client/client_id/client-json",
            'client_status_filter'         => "Status/status/client_status-json",
            'client_renewal_status_filter' => "Renewal Status/renewal_status/client_renewal_status-json"
        ]
    ],

    'listFilters-client_entry_update' => [
        'admin' => [
            'client' => [
                'Edit'          => "client/entry/update",
                'Configure'     => "client/configure",
                'View Details'  => "client/detail",
                'Activity List' => "client/activity-list",
                'User List'     => "client/user-list",
                'Db Overview'   => "client/db-overview",
                'Upload'        => "client/upload"
            ]
        ],
        'portal' => []
    ],

    'listFilters-client_activity' => [
        "admin" => [
            'client_date_filter'     => "Date/date/client_activity_date-json",
            'client_filter'          => "Client/client_id/client-json",
            'client_activity_filter' => "Activity/activity/client_activity-json"
        ],
        "portal" => [
            'client_date_filter'     => "Date/date/client_activity_date-json",
            'client_filter'          => "Client/client_id/client-json",
            'client_activity_filter' => "Activity/activity/client_activity-json"
        ]
    ],

    'cyperp-json'               => [],
    'primarymodule-json'        => [],
    'erp_subscription_plan-json'=> [],
    'client-json'               => [],

    'client_status-json' => [
        "1" => "Active",
        "2" => "In-active"
    ],

    'client_renewal_status-json' => [
        "upcoming" => "Upcoming",
        "expired"  => "Expired"
    ],

    'client_activity-json'      => [],
    'client_activity_date-json' => [],
    'addon_module-json'         => [],

    'interactiveEntity-admin' => ['client'],

    'option_name-json' => [
        "",
        "class-json",
        "section-json",
        "active_sms_service",
        "active_sms_service_username",
        "active_sms_service_password",
        "sms_shortcode"
    ]

];