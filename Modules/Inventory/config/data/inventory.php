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
        'name',
		'code',
		'minimum_threshold',
		'maximum_threshold',
		'current_stock',
		'stock_status',
		'status'
    ],

    /* =========================================================
     | REPORT VIEW (Business intelligence)
     ========================================================= */

    'report' => [
        'id',
        'name',
		'code',
		'minimum_threshold',
		'maximum_threshold',
		'current_stock',
		'stock_status',
		'status'
    ],

    /* =========================================================
     | DETAIL VIEW (Maximum context)
     ========================================================= */

    'detail' => [
        'id',
		'name',
		'code',
        'inventory_group_id',
        'maximum_threshold',
        'current_stock',
        'stock_status',

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
        'maximum_threshold',
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
        'maximum_threshold',
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

	"transaction-types" => [
	    "in"         => "Stock In",
    	"out"        => "Stock Out",
    	"adjustment" => "Adjustment",
    	"transfer"   => "Transfer"
	],

	"reference-types" => [
	    "purchase" => "Purchase",
    	"sale"     => "Sale",
	    "opening"  => "Opening Stock",
    	"manual"   => "Manual Entry",
    	"damage"   => "Damage / Loss"
	],

];
