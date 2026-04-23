<?php
$pg = 'note';

return [

    /*
    |--------------------------------------------------------------------------
    | Thread Types (Conversation category)
    |--------------------------------------------------------------------------
    */
    "thread-types" => [
        "support"   => "Support",
        "complaint" => "Complaint",
        "internal"  => "Internal",
        "follow_up" => "Follow Up",
        "sales"     => "Sales",
    ],

    /*
    |--------------------------------------------------------------------------
    | Thread Priorities
    |--------------------------------------------------------------------------
    */
    "priorities" => [
        "low"    => "Low",
        "medium" => "Medium",
        "high"   => "High",
        "urgent" => "Urgent",
    ],

    /*
    |--------------------------------------------------------------------------
    | Thread Status (Better normalize this later)
    |--------------------------------------------------------------------------
    */
    "statuses" => [
        "open"        => "Open",
        "in_progress" => "In Progress",
        "resolved"    => "Resolved",
        "closed"      => "Closed",
    ],

    /*
    |--------------------------------------------------------------------------
    | Bulk Operations
    |--------------------------------------------------------------------------
    */
    'bulk-operations' => [
        'view:detail' => 'View Conversation',
        'send:sms'    => 'Send SMS',
        'send:email'  => 'Send Email',
        'op:remove'   => 'Delete Thread',
        'op:restore'  => 'Restore Thread',
    ],

    /*
    |--------------------------------------------------------------------------
    | Columns (Unified Structure)
    |--------------------------------------------------------------------------
    */
    'columns' => [

        /* =========================================================
         | LIST VIEW (Fast scanning)
         ========================================================= */
        'list' => [
    'id'              => 'ID',
    'subject'         => 'Subject',
    'type'            => 'Type',
    'priority'        => 'Priority',
    'assigned_to'     => 'Assigned To',
    'last_message'    => 'Last Message',
    'last_message_at' => 'Last Message At',
    'status_label'            => 'Status',
],

        /* =========================================================
         | REPORT VIEW (Analytics / BI)
         ========================================================= */
        'report' => [
    'id'              => 'ID',
    'subject'         => 'Subject',
    'type'            => 'Type',
    'priority'        => 'Priority',
    'assigned_to'     => 'Assigned To',
    'created_at'      => 'Created At',
    'last_message_at' => 'Last Message At',
    'status_label'          => 'Status',
],

        /* =========================================================
         | DETAIL VIEW (Full context)
         ========================================================= */
        'detail' => [
    'id'              => 'ID',
    'subject'         => 'Subject',
    'type'            => 'Type',
    'priority'        => 'Priority',
    'assigned_to'     => 'Assigned To',
    'last_message'    => 'Last Message',
    'last_message_at' => 'Last Message At',
    'status_label'          => 'Status',
],

        /* =========================================================
         | SAMPLE EXPORT
         ========================================================= */
        'sample_export' => [
            'subject',
            'type',
            'priority',
            'assigned_to',
            'created_at',
            'status',
        ],

        /* =========================================================
         | USER SELECTABLE COLUMNS
         ========================================================= */
        'selectable' => [
            'subject',
            'type',
            'priority',
            'assigned_to',
            'last_message_at',
            'status',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Filters (Update for thread-based system)
    |--------------------------------------------------------------------------
    */
    "list-filters" => [
        "admin" => [
            'date'        => "date/created_at/date-range",
            'type'        => "type/type/thread-types",
            'priority'    => "priority/priority/priorities",
            'status'      => "status/status/statuses",
            'assigned_to' => "assigned to/assigned_to/recipients-search",
        ],
        "portal" => [
            'date'     => "date/created_at/date-range",
            'type'     => "type/type/thread-types",
            'priority' => "priority/priority/priorities",
            'status'   => "status/status/statuses",
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Cron Jobs
    |--------------------------------------------------------------------------
    */
    "crons" => [
        'note-reminder' => 'Note Reminder Notifications',
    ],

    /*
    |--------------------------------------------------------------------------
    | Communication Templates
    |--------------------------------------------------------------------------
    */
    "communication-templates" => [
        "thread_created_sms"   => "Thread Created SMS",
        "thread_created_email" => "Thread Created Email",
        "message_added_sms"    => "New Message SMS",
        "message_added_email"  => "New Message Email",
    ],

];