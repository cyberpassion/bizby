<?php
$pg = 'maintenance';

return [

	// Bulk Operations
    'bulk-operations' => [
        'document:maintenance-slip' => 'Print Maintenance Slip',
        'send:sms'                   => 'Send Maintenance SMS',
        'send:email'                 => 'Send Maintenance Email',
        'op:remove'                  => 'Delete Maintenance',
        'op:restore'                 => 'Restore Maintenance',
    ],

	// Default Columns
    'columns' => [

    /* =========================================================
     | LIST VIEW (Fast scanning, operational)
     ========================================================= */

    'list' => [
        'id',
        'asset',
		'issue_type',
		'maintenance_date',
		'maintenance_time',
		'cost',
		'status'
    ],

    /* =========================================================
     | REPORT VIEW (Business intelligence)
     ========================================================= */

    'report' => [
        'id',
        'asset',
		'issue_type',
		'maintenance_date',
		'maintenance_time',
		'cost',
		'status'
    ],

    /* =========================================================
     | DETAIL VIEW (Maximum context)
     ========================================================= */

    'detail' => [
        'id',
        'asset',
		'issue_type',
		'maintenance_date',
		'maintenance_time',
		'cost',
		'status'
    ],

    /* =========================================================
     | SAMPLE EXPORT (Excel / CSV safe)
     ========================================================= */

    'sample_export' => [
        'maintenance_date',
        'maintenance_time',
        'name',
        'phone',
        'maintenance_type',
        'channel',
        'consultant',
        'maintenance_fee',
        'referred_by',
        'referred_to',
        'next_date',
        'status',
    ],

    /* =========================================================
     | USER SELECTABLE COLUMNS
     ========================================================= */

    'selectable' => [
        'maintenance_date',
        'maintenance_time',
        'name',
        'phone',
        'maintenance_type',
        'channel',
        'consultant',
        'maintenance_fee',
        'referred_by',
        'referred_to',
        'next_date',
        'status',
    ],
],

    // Cron Jobs / Documents
    'crons' => [
        'maintenance-visitreminder' => 'Maintenance Visit Reminder',
    ],

	// Documents
    'documents' => [
        'maintenance-slip' => 'Maintenance Slip'
    ],

	// Status
	'statuses' => [
    	'1' => 'Scheduled',
    	'2' => 'In Progress',
    	'3' => 'Completed',
    	'4' => 'On Hold',
    	'5' => 'Cancelled'
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
