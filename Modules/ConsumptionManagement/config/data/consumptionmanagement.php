<?php
$pg = 'consumptionmanagement';

return [

	// Bulk Operations
    'bulk-operations' => [
        'document:consumptionmanagement-slip' => 'Print Consumption Slip',
        'send:sms'                   => 'Send Consumption SMS',
        'send:email'                 => 'Send Consumption Email',
        'op:remove'                  => 'Delete Consumption',
        'op:restore'                 => 'Restore Consumption',
    ],

	// Default Columns
    'columns' => [

    /* =========================================================
     | LIST VIEW (Fast scanning, operational)
     ========================================================= */

    'list' => [
        'id',
        'consumptionmanagement_date',
        'name',
        'phone',
        'channel',
        'consultant',
        'status',
        'consumptionmanagement_fee'
    ],

    /* =========================================================
     | REPORT VIEW (Business intelligence)
     ========================================================= */

    'report' => [
        'consumptionmanagement_date',
        'name',
        'phone',
        'consumptionmanagement_type',
        'channel',
        'consultant',
        'referred_by',
        'referred_to',
        'consumptionmanagement_fee',
        'followup_interval_days',
        'next_date',
        'status',
    ],

    /* =========================================================
     | DETAIL VIEW (Maximum context)
     ========================================================= */

    'detail' => [
        'id',
        'consumptionmanagement_group_id',
        'consumptionmanagement_date',
        'consumptionmanagement_time',
        'day_token_id',
        'channel',
        'consultant',
        'reason',

        // Person fields (useful in detail)
        'name',
        'phone',
        'email',
        'gender',
        'dob',

        'consumptionmanagement_type',
        'consumptionmanagement_fee',
        'referred_by',
        'referred_to',
        'followup_interval_days',
        'next_date',
        'thread_parent',
        'status',
    ],

    /* =========================================================
     | SAMPLE EXPORT (Excel / CSV safe)
     ========================================================= */

    'sample_export' => [
        'consumptionmanagement_date',
        'consumptionmanagement_time',
        'name',
        'phone',
        'consumptionmanagement_type',
        'channel',
        'consultant',
        'consumptionmanagement_fee',
        'referred_by',
        'referred_to',
        'next_date',
        'status',
    ],

    /* =========================================================
     | USER SELECTABLE COLUMNS
     ========================================================= */

    'selectable' => [
        'consumptionmanagement_date',
        'consumptionmanagement_time',
        'name',
        'phone',
        'consumptionmanagement_type',
        'channel',
        'consultant',
        'consumptionmanagement_fee',
        'referred_by',
        'referred_to',
        'next_date',
        'status',
    ],
],

    // Cron Jobs / Documents
    'crons' => [
        'consumptionmanagement-visitreminder' => 'Consumption Visit Reminder',
    ],

	// Documents
    'documents' => [
        'consumptionmanagement-slip' => 'Consumption Slip'
    ],

	// Status
    'statuses' => [
        '1'  => 'Active',
        '2'  => 'Deleted',
        '21' => 'Departed',
        '22' => 'Cancelled',
    ],

	// Uploads
    'uploads' => [
        'image' => 'Image',
    ],

	/* =========================
     | CUSTOM SPECIFIC FOR MODULE
     ========================= */

	// Default Intervals
	'modes' => [
        'refill'  => 'Refill',
        'consumption' => 'Consumption'
    ],

];
