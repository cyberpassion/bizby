<?php
$pg = 'customer';

return [

    // -----------------------------------------
    // Communication Templates
    // -----------------------------------------
    "communicationTemplate-$pg" => [
        "customer_entry_new_sms"                => "New Customer Entry SMS",
        "customer_entry_new_whatsapp"           => "New Customer Entry Whatsapp",
        "customer_entry_new_email"              => "New Customer Entry Email",
        "customer_next_date_reminder_sms"       => "Customer Next Date Reminder SMS",
        "customer_next_date_reminder_whatsapp"  => "Customer Next Date Reminder Whatsapp",
        "customer_next_date_reminder_email"     => "Customer Next Date Reminder Email",
        "customer_birthday_new_sms"             => "Customer Birthday SMS",
        "customer_birthday_new_whatsapp"        => "Customer Birthday Whatsapp",
        "customer_birthday_new_email"           => "Customer Birthday Email",
    ],

    // -----------------------------------------
    // Column Name Mapping
    // -----------------------------------------
    "columnNameMapping-$pg" => [
        "customer_id"              => "ID",
        "customer_name"            => "Name",
        "customer_type"            => "Type",
        "additional_contacts"      => "Contacts",
        "additional_information"   => "Information",
        "next_date"                => "Next Date",
    ],

    // -----------------------------------------
    // Parent Pages
    // -----------------------------------------
    "parentpageslist-$pg" => [
        "list"      => "Customer List",
        "entry"     => "New Entry",
        "report"    => "Reports",
        "upload"    => "Upload",
        "settings"  => "Settings"
    ],

    // -----------------------------------------
    // Child Pages
    // -----------------------------------------
    "childpageslist-$pg" => [
        "list" => [
            "view"      => "View",
            "filter"    => "Filter",
            "export"    => "Export"
        ],
        "entry" => [
            "add"   => "Add Customer",
            "edit"  => "Edit Customer"
        ],
        "report" => [
            "summary"   => "Summary Report",
            "detailed"  => "Detailed Report"
        ],
        "upload" => [
            "docs"  => "Upload Customer Docs"
        ],
        "settings" => [
            "general"   => "General Settings",
        ]
    ],

    // -----------------------------------------
    // Module Tables
    // -----------------------------------------
    "moduleTables-$pg" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_customer"
    ],

    // -----------------------------------------
    // Filters
    // -----------------------------------------
    "filters-$pg" => [
        "sort"      => "Customer Type",
        "state"     => "State",
        "nextdate"  => "Next Date",
        "status"    => "Status",
    ],

    // -----------------------------------------
    // Default Columns
    // -----------------------------------------
    "defaultColumns-$pg" => [
        "entry"             => ['customer_id','customer_name','phone_number','remark','additional_information','additional_contacts','next_date','status'],
        "list"              => ['customer_id','customer_name','phone_number','remark','additional_information','additional_contacts','next_date','status'],
        "detail"            => ['customer_id','customer_name','phone_number','remark','additional_information','additional_contacts','next_date','status'],
        "report"            => ['customer_id','customer_name','phone_number','remark','additional_information','additional_contacts','next_date','status'],
        "sample_export"     => ['sno','customer_name','phone_number','email_id','remark','next_date'],
        "selected_columns"  => ['customer_name','phone_number','email_id','remark','additional_information','additional_contacts','next_date']
    ],

    // -----------------------------------------
    // Permissions
    // -----------------------------------------
    "permissionKeys-$pg" => [
        "create"        => "Create Customer",
        "edit"          => "Edit Customer",
        "delete"        => "Delete Customer",
        "view"          => "View Customer",
        "export"        => "Export Customer Data"
    ],

    // -----------------------------------------
    // Page Structure
    // -----------------------------------------
    "pgStructure-$pg" => [
        "list" => [
            "title"     => "Customer List",
            "addBtn"    => true,
            "filters"   => true,
            "export"    => true
        ],
        "entry" => [
            "title"     => "New Customer Entry",
            "fields"    => ["customer_name","phone_number","remark","additional_information","next_date"]
        ],
        "report" => [
            "title"     => "Customer Reports"
        ],
        "upload" => [
            "title"     => "Upload Customer Documents"
        ],
        "settings" => [
            "title"     => "Customer Settings"
        ]
    ],

    // -----------------------------------------
    // Mandatory Fields
    // -----------------------------------------
    "mandatoryFields-$pg" => [
        "customer_name",
        "phone_number"
    ],

    // -----------------------------------------
    // Date Fields
    // -----------------------------------------
    "dateFields-$pg" => [
        "dob",
        "next_date"
    ],

    // -----------------------------------------
    // Duplicacy Check Fields
    // -----------------------------------------
    "duplicacyCheckFields-$pg" => [
        "phone_number"
    ],

    // -----------------------------------------
    // Cron Jobs
    // -----------------------------------------
    "cronList-$pg" => [
        "customer-due_date"   => "Customer Due Date",
        "customer-birthday"   => "Customer Birthday Message"
    ]
];
