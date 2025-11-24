<?php
$pg = 'communication';

return [

    // -----------------------------
    // Communication Templates
    // -----------------------------
    'communicationTemplate-communication' => [
        "communication_entry_new_sms"             => "New Communication Entry SMS",
        "communication_entry_new_whatsapp"        => "New Communication Entry Whatsapp",
        "communication_entry_new_email"           => "New Communication Entry Email",
        "communication_reminder_new_sms"          => "New Communication Reminder SMS",
        "communication_reminder_new_whatsapp"     => "New Communication Reminder Whatsapp",
        "communication_reminder_new_email"        => "New Communication Reminder Email",
    ],

    // -----------------------------
    // Column Name Mapping
    // -----------------------------
    'columnNameMapping-communication' => [
        "communication_id"       => "ID",
        "client_id"              => "Client",
        "mobile"                 => "Mobile",
        "email"                  => "Email",
        "type"                   => "Type",
        "template"               => "Template",
        "subject"                => "Subject",
        "message"                => "Message",
        "status"                 => "Status",
        "sent_at"                => "Sent At",
        "created_at"             => "Created At",
        "updated_at"             => "Updated At"
    ],

    // -----------------------------
    // Parent Page / Child Pages
    // -----------------------------
    'parentpageslist-communication' => [
        "list"      => "Communication List",
        "entry"     => "New Entry",
        "template"  => "Templates",
        "report"    => "Reports",
        "settings"  => "Settings"
    ],

    'childpageslist-communication' => [
        "list" => [
            "view" => "View",
            "filter" => "Filter",
            "export" => "Export"
        ],
        "entry" => [
            "add" => "Add Communication",
            "send" => "Send Now",
        ],
        "template" => [
            "add" => "Add Template",
            "edit" => "Edit Template",
        ],
        "report" => [
            "summary" => "Summary Report",
            "detailed" => "Detailed Report"
        ],
        "settings" => [
            "sender_id" => "Sender ID",
            "email_config" => "Email Config",
            "whatsapp_api" => "WhatsApp Api"
        ]
    ],

    // -----------------------------
    // Table List
    // -----------------------------
    'moduleTables-communication' => [
        "communication",
        "communication_template",
        "communication_log"
    ],

    // -----------------------------
    // Filters
    // -----------------------------
    'filters-communication' => [
        "date"          => "Date",
        "type"          => "Type",
        "status"        => "Status",
        "client"        => "Client",
        "mobile"        => "Mobile"
    ],

    // -----------------------------
    // Permission Keys
    // -----------------------------
    'permissionKeys-communication' => [
        "create"    => "Create Communication",
        "send"      => "Send Communication",
        "edit"      => "Edit Template",
        "delete"    => "Delete",
        "view"      => "View Communication",
        "export"    => "Export Data"
    ],

    // -----------------------------
    // Page Structure
    // -----------------------------
    'pgStructure-communication' => [
        "list" => [
            "title"     => "Communication List",
            "addBtn"    => true,
            "filters"   => true,
            "export"    => true
        ],
        "entry" => [
            "title"     => "New Communication Entry",
            "fields"    => ["mobile", "email", "type", "template", "subject", "message"]
        ],
        "template" => [
            "title"     => "Communication Templates",
            "fields"    => ["type", "title", "body"]
        ],
        "report" => [
            "title"     => "Communication Reports"
        ],
        "settings" => [
            "title"     => "Communication Settings"
        ]
    ]

];
