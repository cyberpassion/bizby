<?php
$pg = 'asset';

return [

	// Bulk Operations
    'bulk-operations' => [
        'document:asset-slip' => 'Print Asset Slip',
        'send:sms'                   => 'Send Asset SMS',
        'send:email'                 => 'Send Asset Email',
        'op:remove'                  => 'Delete Asset',
        'op:restore'                 => 'Restore Asset',
    ],

	// Default Columns
    'columns' => [

    /* =========================================================
     | LIST VIEW (Fast scanning, operational)
     ========================================================= */

    'list' => [
        'id',
        'asset_code',
		'name',
		'serial_number',
		'purchase_date',
		'status'
    ],

    /* =========================================================
     | REPORT VIEW (Business intelligence)
     ========================================================= */

    'report' => [
        'id',
        'asset',
		'issue_type',
		'asset_date',
		'asset_time',
		'cost',
		'status'
    ],

    /* =========================================================
     | DETAIL VIEW (Maximum context)
     ========================================================= */

    'detail' => [
        'id',
        'asset_group_id',
        'asset_date',
        'asset_time',
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

        'asset_type',
        'asset_fee',
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
        'asset_date',
        'asset_time',
        'name',
        'phone',
        'asset_type',
        'channel',
        'consultant',
        'asset_fee',
        'referred_by',
        'referred_to',
        'next_date',
        'status',
    ],

    /* =========================================================
     | USER SELECTABLE COLUMNS
     ========================================================= */

    'selectable' => [
        'asset_date',
        'asset_time',
        'name',
        'phone',
        'asset_type',
        'channel',
        'consultant',
        'asset_fee',
        'referred_by',
        'referred_to',
        'next_date',
        'status',
    ],
],

    // Cron Jobs / Documents
    'crons' => [
        'asset-visitreminder' => 'Asset Visit Reminder',
    ],

	// Documents
    'documents' => [
        'asset-slip' => 'Asset Slip'
    ],

	// Status
    'statuses' => [
	    '1' => 'Active',
    	'2' => 'In Maintenance',
    	'3' => 'Inactive',
    	'4' => 'Disposed',
    	'5' => 'Deleted'
	],

	// Uploads
    'uploads' => [
		'image' => 'Asset Image',
	    'purchase_invoice' => 'Purchase Invoice',
    	'warranty_certificate' => 'Warranty Certificate',
    	'asset_registration_document' => 'Asset Registration Document',
	    'insurance_papers' => 'Insurance Papers',
    	'maintenance_records' => 'Maintenance Records',
    	'service_reports' => 'Service Reports',
    	'calibration_certificate' => 'Calibration Certificate (for equipment)',
    	'qr_barcode_document' => 'QR Code / Barcode Document',
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
