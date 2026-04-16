<?php
$pg = 'inventory';

return [

	// Bulk Operations
    'bulk-operations' => [
        'document:inventory-slip' => 'Print Inventory Slip',
        'send:sms'                   => 'Send Inventory SMS',
        'send:email'                 => 'Send Inventory Email',
        'op:remove'                  => 'Delete Inventory',
        'op:restore'                 => 'Restore Inventory',
    ],

	// Default Columns
    'columns' => [

    /* =========================================================
     | LIST VIEW (Fast scanning, operational)
     ========================================================= */

    'list' => [
        'id',
        'inventory',
		'issue_type',
		'inventory_date',
		'inventory_time',
		'cost',
		'status'
    ],

    /* =========================================================
     | REPORT VIEW (Business intelligence)
     ========================================================= */

    'report' => [
        'id',
        'inventory',
		'issue_type',
		'inventory_date',
		'inventory_time',
		'cost',
		'status'
    ],

    /* =========================================================
     | DETAIL VIEW (Maximum context)
     ========================================================= */

    'detail' => [
        'id',
        'inventory_group_id',
        'inventory_date',
        'inventory_time',
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

        'inventory_type',
        'inventory_fee',
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
        'inventory_date',
        'inventory_time',
        'name',
        'phone',
        'inventory_type',
        'channel',
        'consultant',
        'inventory_fee',
        'referred_by',
        'referred_to',
        'next_date',
        'status',
    ],

    /* =========================================================
     | USER SELECTABLE COLUMNS
     ========================================================= */

    'selectable' => [
        'inventory_date',
        'inventory_time',
        'name',
        'phone',
        'inventory_type',
        'channel',
        'consultant',
        'inventory_fee',
        'referred_by',
        'referred_to',
        'next_date',
        'status',
    ],
],

    // Cron Jobs / Documents
    'crons' => [
        'inventory-visitreminder' => 'Inventory Visit Reminder',
    ],

	// Documents
    'documents' => [
        'inventory-slip' => 'Inventory Slip'
    ],

	// Status
    'statuses' => [
	    '1' => 'Available',
    	'2' => 'Reserved',
	    '3' => 'Out of Stock',
    	'4' => 'Damaged',
    	'5' => 'Expired',
    	'6' => 'Deleted'
	],

	// Uploads
    'uploads' => [
        'image' => 'Image',
    ],

	/* =========================
     | CUSTOM SPECIFIC FOR MODULE
     ========================= */

	// Default Intervals
	'default-intervals' => [
        '5'  => '5 Minutes',
        '10' => '10 Minutes',
        '15' => '15 Minutes',
        '20' => '20 Minutes',
        '30' => '30 Minutes',
    ],

	// Next Days
    'next-days' => [
        '3 d'  => '3 Days',
        '4 d'  => '4 Days',
        '5 d'  => '5 Days',
        '6 d'  => '6 Days',
        '7 d'  => '7 Days',
        '10 d' => '10 Days',
        '12 d' => '12 Days',
        '15 d' => '15 Days',
        '30 d' => '30 Days',
    ],

];
