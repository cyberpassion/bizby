<?php
$pg = 'center';

return [

	// Bulk Operations
    'bulk-operations' => [
        'document:center-slip' => 'Print Center Slip',
        'send:sms'                   => 'Send Center SMS',
        'send:email'                 => 'Send Center Email',
        'op:remove'                  => 'Delete Center',
        'op:restore'                 => 'Restore Center',
    ],

	// Default Columns
    'columns' => [

    /* =========================================================
     | LIST VIEW (Fast scanning, operational)
     ========================================================= */

    'list' => [
    'id'           => 'ID',
    'name'         => 'Name',
    'location'     => 'Location',
    'contact'      => 'Contact',
    'status_label' => 'Status',
],

    /* =========================================================
     | REPORT VIEW (Business intelligence)
     ========================================================= */

    'report' => [
    'id'           => 'ID',
    'name'         => 'Name',
    'location'     => 'Location',
    'contact'      => 'Contact',
    'status_label' => 'Status',
],

    /* =========================================================
     | DETAIL VIEW (Maximum context)
     ========================================================= */

    'detail' => [

    /* =========================
     | CORE
     ========================= */
    'id'   => 'ID',
    'code' => 'Code',
    'name' => 'Name',

    /* =========================
     | LOCATION & CONTACT
     ========================= */
    'location' => 'Location',
    'contact'  => 'Contact',

    /* =========================
     | CAPACITY
     ========================= */
    'capacity' => 'Capacity',

    /* =========================
     | STATUS
     ========================= */
    'status_label' => 'Status',

    /* =========================
     | SYSTEM
     ========================= */
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
],

    /* =========================================================
     | SAMPLE EXPORT (Excel / CSV safe)
     ========================================================= */

    'sample_export' => [
        'id',
        'name',
        'location',
		'contact',
        'status_label'
    ],

    /* =========================================================
     | USER SELECTABLE COLUMNS
     ========================================================= */

    'selectable' => [
        'id',
        'name',
        'location',
		'contact',
        'status_label'
    ],
],

    // Cron Jobs / Documents
    'crons' => [
        'center-visitreminder' => 'Center Visit Reminder',
    ],

	// Documents
    'documents' => [
        'detail' => 'Detail'
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
		'image' => 'Center Images',
	    'center_registration_certificate' => 'Center Registration Certificate',
    	'government_approval_license' => 'Government Approval / License',
    	'building_safety_certificate' => 'Building Safety Certificate',
	    'fire_noc_certificate' => 'Fire NOC Certificate',
    	'utility_bills' => 'Electricity & Water Bills',
    	'layout_building_map' => 'Layout / Building Map',
    	'insurance_documents' => 'Insurance Documents',
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
