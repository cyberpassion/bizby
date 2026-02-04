<?php
$pg = 'checklist';

return [

    /* ===============================
     | Database Tables
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
        "cyp_checklist",
        "cyp_checklist_item"
    ],

    /* ===============================
     | Checklist Status
     =============================== */
    'statuses' => [
        '1'  => 'Under Process',
        '15' => 'Completed',
        '2'  => 'Deleted',
        '21' => 'Rejected'
    ],

    /* ===============================
     | Listing Status
     =============================== */
    'listing-status' => [
        '1' => 'Active',
        '2' => 'Deleted'
    ],

    /* ===============================
     | Point Status
     =============================== */
    'point-status' => [
        '1'  => 'Active',
        '11' => 'Draft',
        '12' => 'Under Review',
        '15' => 'Completed',
        '2'  => 'Deleted',
        '21' => 'Rejected'
    ],

    /* ===============================
     | List Columns
     =============================== */
    'list-columns' => [
        'id',
        'checklist_name',
        'listing_id',
        'is_sequence_to_follow',
        'checklist_by',
        'checklist_by_type',
        'status',
        'created_at',
    ],

    /* ===============================
     | Report Columns
     =============================== */
    'report-columns' => [
        'id',
        'checklist_name',
        'checklist_description',
        'listing_id',
        'is_sequence_to_follow',
        'status_remark',
        'checklist_by',
        'checklist_by_type',
        'status',
        'created_at',
    ],

    /* ===============================
     | Filters
     =============================== */
    'list-filters' => [
        'checklist_name',
        'listing_id',
        'checklist_by_type',
        'status',
    ],

    /* ===============================
     | Search
     =============================== */
    'search-column' => [
        'checklist_name'
    ],

    /* ===============================
     | Point Duration Types
     =============================== */
    'point-duration-types' => [
        'minutes' => 'Minutes',
        'hours'   => 'Hours',
        'days'    => 'Days',
        'months'  => 'Months'
    ],
];
