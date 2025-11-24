<?php
$pg = 'communication';

return [

    // -----------------------------
    // Communication Templates
    // -----------------------------
    "communicationTemplate-contact" => [
        "contact_entry_new_sms"                => "New Contact Entry SMS",
        "contact_entry_new_whatsapp"           => "New Contact Entry Whatsapp",
        "contact_entry_new_email"              => "New Contact Entry Email",
        "contact_next_date_reminder_sms"       => "Contact Next Date Reminder SMS",
        "contact_next_date_reminder_whatsapp"  => "Contact Next Date Reminder Whatsapp",
        "contact_next_date_reminder_email"     => "Contact Next Date Reminder Email",
        "contact_birthday_new_sms"             => "Contact Birthday SMS",
        "contact_birthday_new_whatsapp"        => "Contact Birthday Whatsapp",
        "contact_birthday_new_email"           => "Contact Birthday Email",
    ],

    // -----------------------------
    // Column Name Mapping
    // -----------------------------
    "columnNameMapping-contact" => [
        "contact_id"             => "ID",
        "contact_name"           => "Name",
        "contact_type"           => "Type",
        "additional_information" => "Information",
    ],

    // -----------------------------
    // Menu Items
    // -----------------------------
    "menuItem-contact" => [
        "admin"  => "default_features_menu_list(contact)",
        "portal" => []
    ],

    // -----------------------------
    // Page Structure
    // -----------------------------
    "pgStructure-contact" => [
        "contact" => [
            "forms/form" => ["entry", "report", "upload", "settings"],
            "lists/list" => ["list"],
            "views/view" => ["home", "document", "profile", "detail", "history"]
        ]
    ],

    // -----------------------------
    // CRON List
    // -----------------------------
    "cronList-contact" => [
        "contact-due_date" => "Contact Due Date",
        "contact-birthday" => "Contact Birthday Message"
    ],

    // -----------------------------
    // Mandatory Options
    // -----------------------------
    "mandatoryOptionsBeforeUsing-contact" => [
        "missing_option" => []
    ],

    // -----------------------------
    // Module Tables
    // -----------------------------
    "moduleTable-contact" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_contact"
    ],

    // -----------------------------
    // Default Columns
    // -----------------------------
    "defaultColumns-contact" => [
        "entry"            => ["contact_id", "contact_name", "phone_number", "group_name", "tags", "status"],
        "list"             => ["contact_id", "contact_name", "phone_number", "group_name", "tags", "status"],
        "detail"           => ["contact_id", "contact_name", "phone_number", "group_name", "tags", "status"],
        "report"           => ["contact_id", "contact_name", "phone_number", "group_name", "tags", "status"],
        "sample_export"    => ["sno", "contact_name", "phone_number", "email_id", "next_date"],
        "selected_columns" => ["contact_name", "phone_number", "email_id"]
    ],

    // -----------------------------
    // Interactive Entity
    // -----------------------------
    "interactiveEntity-contact" => ["contact"],

    // -----------------------------
    // Form Mandatory Fields
    // -----------------------------
    "mandatoryFields-contact_entry" => ["contact_name", "phone_number"],

    // -----------------------------
    // Date Fields
    // -----------------------------
    "dateFields-contact_entry" => ["dob", "next_date"],

    // -----------------------------
    // Additional Fields
    // -----------------------------
    "additionalFields-contact_entry" => [],

    // -----------------------------
    // Duplicate Check Fields
    // -----------------------------
    "duplicacyCheckFields-contact_entry_new" => ["phone_number"],

    // -----------------------------
    // List Filters
    // -----------------------------
    "listFilters-contact_entry" => [
        "admin" => [
            "sort"      => "Contact Type/contact_type/business_type-json",
            "state"     => "State/state/indian_state-json",
            "nextdate"  => "Next Date/range-next_date/filter_date_range-json",
            "status"    => "Status/status/contact_status-json"
        ],
        "portal" => [
            "sort"      => "Contact Type/contact_type/business_type-json",
            "state"     => "State/state/indian_state-json",
            "nextdate"  => "Next Date/range-next_date/filter_date_range-json",
            "status"    => "Status/status/contact_status-json"
        ]
    ],

    // -----------------------------
    // List Filters - Update Page
    // -----------------------------
    "listFilters-contact_entry_update" => [
        "admin" => [
            "contact" => [
                "Profile"       => "contact/profile",
                "Edit"          => "contact/entry/update",
                "Upload"        => "contact/upload",
                "View Details"  => "contact/detail",
                "View History"  => "contact/history",
                "Download Docs" => "zip_download(contact)"
            ]
        ]
    ],

    // -----------------------------
    // Contact Report Filters
    // -----------------------------
    "listFilters-contact_contact-report" => [
        "admin" => [
            "report_type_filter" => "Report Type/report_type/contact_type-json",
            "status_filter"      => "Status/status/contact_status-json"
        ],
        "portal" => [
            "report_type_filter" => "Report Type/report_type/contact_type-json",
            "status_filter"      => "Status/status/contact_status-json"
        ]
    ],

    // -----------------------------
    // Permission (Admin)
    // -----------------------------
    "permissionAdmin-contact" => [
        "restricted" => [
            "2" => [["pg" => "contact", "sub_pg" => "settings"]],
            "3" => [["pg" => "contact", "sub_pg" => "settings"]],
        ],
        "allowed" => []
    ],

    // -----------------------------
    // Permission (Portal)
    // -----------------------------
    "permissionPortal-contact" => [
        "restricted" => [],
        "allowed" => [
            ["pg" => "contact", "sub_pg" => "home"],
            ["pg" => "contact", "sub_pg" => "profile"],
            ["pg" => "contact", "sub_pg" => "document"],
            ["pg" => "contact", "sub_pg" => "history"],
        ]
    ],

    // -----------------------------
    // Permission Allowed Filters (Portal)
    // -----------------------------
    // "permissionAllowedFiltersPortal-contact" => [
    //     "profile" => [["contact_id" => '{$login_id}']],
    //     "list"    => [["contact_id" => '{$login_id}']],
    //     "report"  => [["contact_id" => '{$login_id}']]
    // ],

    // -----------------------------
    // Form Prefill
    // -----------------------------
    "formPrefills-contact_entry" => [
        "columns" => [
            "product"       => "default_product",
            "contact_mode"  => "default_contact_mode",
            "state"         => "default_indian_state"
        ],
        "groups" => [
            "current_date" => ["contact_date"]
        ]
    ],

    // -----------------------------
    // Search Columns
    // -----------------------------
    "contact_search_column-json" => ["contact_name", "phone_number"],

    // -----------------------------
    // Group By Result
    // -----------------------------
    "contact_group_results_by-json" => [
        "contact_type" => "CUSTOMER TYPE",
        "status"       => "STATUS"
    ],

    // -----------------------------
    // Sort By Result
    // -----------------------------
    "contact_sort_results_by-json" => [
        "contact_name" => "CUSTOMER NAME",
        "contact_id"   => "id"
    ],

    // -----------------------------
    // Display Type
    // -----------------------------
    "contact_group_results_display_type-json" => [
        "complete_list" => "COMPLETE LIST"
    ],

    // -----------------------------
    // Bulk Operations
    // -----------------------------
    "contact_bulk_operation-list" => [
        "view:detail" => "View Contact Details",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

];
