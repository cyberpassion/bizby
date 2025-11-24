<?php
$pg = 'eventmanager';

return [

    // -------------------------------
    // Communication Templates
    // -------------------------------
    "communicationTemplate-eventmanager" => [
        "eventmanager_entry_new_sms"       => "New Eventmanager Entry SMS",
        "eventmanager_entry_new_whatsapp"  => "New Eventmanager Entry Whatsapp",
        "eventmanager_entry_new_email"     => "New Eventmanager Entry Email",
    ],

    // -------------------------------
    // Column Name Mapping
    // -------------------------------
    "columnNameMapping-eventmanager" => [
        'event_id'            => 'ID',
        'event_start_date'    => 'Start Date',
        'event_end_date'      => 'End Date',
        'event_on'            => 'Date',
        'event_participants'  => 'Participants',
        'event_name'          => 'Name',
        'event_description'   => 'Description'
    ],

    // -------------------------------
    // Menu
    // -------------------------------
    "menuItem-eventmanager" => [
        "admin"  => [],
        "portal" => []
    ],

    // -------------------------------
    // Page Structure
    // -------------------------------
    "pgStructure-eventmanager" => [
        "eventmanager" => [
            'forms/form'  => ['entry', 'upload', 'settings', 'report'],
            'lists/list'  => ['list'],
            'views/view'  => ['home','document','profile','detail','history']
        ]
    ],

    // -------------------------------
    // Mandatory Options
    // -------------------------------
    "mandatoryOptionsBeforeUsing-eventmanager" => [
        "missing_option" => [
            "Event Types" => "event_type-json"
        ]
    ],

    // -------------------------------
    // Module Tables
    // -------------------------------
    "moduleTable-eventmanager" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_event"
    ],

    // -------------------------------
    // Default Columns
    // -------------------------------
    "defaultColumns-eventmanager" => [
        'entry'             => ['event_id', 'event_name', 'event_description', 'event_on', 'event_participants','tags', 'status'],
        'list'              => ['event_id', 'event_name', 'event_description', 'event_on', 'event_participants','tags', 'status'],
        'detail'            => ['event_id', 'event_name', 'event_description', 'event_on', 'event_participants','tags', 'status'],
        'report'            => ['event_id', 'event_name', 'event_description', 'event_on', 'event_participants','tags', 'status'],
        'sample_export'     => ['sno', 'event_name', 'event_description', 'event_on', 'event_participants'],
        'selected_columns'  => ['event_name', 'event_description', 'event_on', 'event_participants']
    ],

    // -------------------------------
    // Cron List
    // -------------------------------
    "cronList-eventmanager" => [
        "eventmanager-notification" => "Event Notification"
    ],

    // -------------------------------
    // Mandatory Fields
    // -------------------------------
    "mandatoryFields-eventmanager_entry" => ['event_name','event_participants'],

    // -------------------------------
    // Date Fields
    // -------------------------------
    "dateFields-eventmanager_entry" => ['date'],

    // -------------------------------
    // Additional Fields
    // -------------------------------
    "additionalFields-eventmanager_entry" => [],

    // -------------------------------
    // List Filters
    // -------------------------------
    "listFilters-eventmanager_entry" => [
        "admin" => [
            'date_filter'               => "Date/event_date/event_date-json",
            'eventmanager_head_filter'  => "Type/event_type/event_type-json",
            'status_filter'             => "Status/status/eventmanager_status-json"
        ],
        "portal" => [
            'date_filter'               => "Date/event_date/event_date-json",
            'eventmanager_head_filter'  => "Type/event_type/event_type-json",
            'status_filter'             => "Status/status/eventmanager_status-json"
        ]
    ],

    // -------------------------------
    // Permission (Admin)
    // -------------------------------
    "permissionAdmin-eventmanager" => [
        "restricted" => [
            "2" => [["pg"=>"eventmanager","sub_pg"=>"settings"]],
            "3" => [["pg"=>"eventmanager","sub_pg"=>"settings"]]
        ],
        "allowed" => []
    ],

    // -------------------------------
    // Permission (Portal)
    // -------------------------------
    "permissionPortal-eventmanager" => [
        "restricted" => [],
        "allowed" => [
            ["pg"=>"eventmanager","sub_pg"=>"home"],
            ["pg"=>"eventmanager","sub_pg"=>"list"],
            ["pg"=>"eventmanager","sub_pg"=>"report"]
        ]
    ],

    // -------------------------------
    // Allowed Portal Filters
    // -------------------------------
    // "permissionAllowedFiltersPortal-eventmanager" => [
    //     "entry"  => [["participant"=>'{$login_type}-{$byline}']],
    //     "list"   => [["participant"=>'{$login_type}-{$byline}']],
    //     "report" => [["participant"=>'{$login_type}-{$byline}']]
    // ],

    // -------------------------------
    // Prefills
    // -------------------------------
    "formPrefills-eventmanager_entry" => [
        "columns" => [
            'product'       => 'default_product',
            'contact_mode'  => 'default_contact_mode',
            'state'         => 'default_indian_state'
        ],
        "groups" => [
            'current_date' => ['contact_date']
        ]
    ],

    // -------------------------------
    // Bulk Operations
    // -------------------------------
    "eventmanager_bulk_operation-list" => [
        "view:detail"  => "View Event Details",
        "send:sms"     => "Send SMS to Participants",
        "send:email"   => "Send Email to Participants",
        "op:remove"    => "Delete Event",
        "op:restore"   => "Restore Event"
    ],

    // -------------------------------
    // Event Status
    // -------------------------------
    "eventmanager_status-json" => [
        "1"  => "PLANNED",
        "11" => "COMPLETED",
        "13" => "CONCELLED",
        "2"  => "DELETED"
    ],

];
