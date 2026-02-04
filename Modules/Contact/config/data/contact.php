<?php
$pg = 'contact';

return [

    /* ===============================
     | Module Tables
     =============================== */
    'tables' => [
        "terms",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "uploads",
        "cyp_notification",
        "cyp_message",
        "cyp_contact"
    ],

    /* ===============================
     | Group / Sort Options
     =============================== */
    'group-results-by' => [
        'contact_type' => 'CUSTOMER TYPE',
        'status'       => 'STATUS'
    ],

    'sort-results-by' => [
        'contact_name' => 'CUSTOMER NAME',
        'contact_id'   => 'ID'
    ],

    /* ===============================
     | Cron Jobs
     =============================== */
    'crons' => [
        'contact-due_date' => 'Contact Due Date',
        'contact-birthday' => 'Contact Birthday Message'
    ],

    /* ===============================
     | List Filters
     =============================== */
    'list-filters-advanced' => [
        'admin' => [
            'sort'     => "Contact Type/contact_type/business_type-json",
            'state'    => "State/state/indian_state-json",
            'nextdate' => "Next Date/range-next_date/filter_date_range-json",
            'status'   => "Status/status/contact_status-json"
        ],
        'portal' => [
            'sort'     => "Contact Type/contact_type/business_type-json",
            'state'    => "State/state/indian_state-json",
            'nextdate' => "Next Date/range-next_date/filter_date_range-json",
            'status'   => "Status/status/contact_status-json"
        ]
    ],

    /* ===============================
     | Bulk Operations
     =============================== */
    'bulk-operations' => [
        "view:detail" => "View Contact Details",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

    /* ===============================
     | Default Columns
     =============================== */
    'default-columns' => [
        'entry'  => ['contact_id','contact_name','phone_number','group_name','tags','status'],
        'list'   => ['contact_id','contact_name','phone_number','group_name','tags','status'],
        'detail' => ['contact_id','contact_name','phone_number','group_name','tags','status'],
        'report' => ['contact_id','contact_name','phone_number','group_name','tags','status'],
    ],

    /* ===============================
     | List / Report Columns
     =============================== */
    'list-columns' => [
        'id','name','phone','email','reference_name','status'
    ],

    'report-columns' => [
        'id','reference_name','name','gender','age','phone','email','status'
    ],

    /* ===============================
     | Communication Templates
     =============================== */
    'communication-templates' => [
        "contact_entry_new_sms",
        "contact_entry_new_whatsapp",
        "contact_entry_new_email",
        "contact_next_date_reminder_sms",
        "contact_next_date_reminder_whatsapp",
        "contact_next_date_reminder_email",
        "contact_birthday_new_sms",
        "contact_birthday_new_whatsapp",
        "contact_birthday_new_email",
    ],

    /* ===============================
     | Column Name Mapping
     =============================== */
    'column-name-mapping' => [
        'contact_id'   => 'ID',
        'contact_name' => 'Name',
        'contact_type' => 'Type',
        'additional_information' => 'Information'
    ],

    /* ===============================
     | Mandatory / Validation
     =============================== */
    'mandatory-fields' => [
        'entry-update' => ['contact_name','phone_number']
    ],

    'date-fields' => [
        'entry-update' => ['dob','next_date']
    ],

    'duplicacy-check-fields' => [
        'entry-new' => ['phone_number']
    ],

    /* ===============================
     | Portal Allowed Filters
     =============================== */
    'permission-allowed-filters-portal' => [
        'profile' => [[ 'contact_id' => '{$login_id}' ]],
        'list'    => [[ 'contact_id' => '{$login_id}' ]],
        'report'  => [[ 'contact_id' => '{$login_id}' ]]
    ],

    /* ===============================
     | Search
     =============================== */
    'search-columns' => ['contact_name','phone_number'],
];
