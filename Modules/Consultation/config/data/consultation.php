<?php
$pg = 'consultation';

return [

	// Bulk Operations
    'bulk-operations' => [
        'document:consultation-slip' => 'Print Consultation Slip',
        'send:sms'                   => 'Send Consultation SMS',
        'send:email'                 => 'Send Consultation Email',
        'op:remove'                  => 'Delete Consultation',
        'op:restore'                 => 'Restore Consultation',
    ],

	// Default Columns
    'columns' => [

    /* =========================================================
     | LIST VIEW (Fast scanning, operational)
     ========================================================= */

    'list' => [
        'id'	=> 'ID',
        'consultation_date'	=> 'Date',
        'name'	=> 'Name',
        'phone'	=> 'Phone',
        'channel'	=> 'Channel',
        'consultant_label'	=> 'Consultant',
        'status_label'	=> 'Status',
        'consultation_fee'	=> 'Fee'
    ],

    /* =========================================================
     | REPORT VIEW (Business intelligence)
     ========================================================= */

    'report' => [
    'consultation_date'      => 'Date',
    'name'                   => 'Name',
    'phone'                  => 'Phone',
    'consultation_type'      => 'Type',
    'channel'                => 'Channel',
    'consultant_label'       => 'Consultant',
    'referred_by'            => 'Referred By',
    'referred_to'            => 'Referred To',
    'consultation_fee'       => 'Fee',
    'followup_interval_days' => 'Follow-up Interval',
    'next_date'              => 'Next Date',
    'status_label'           => 'Status',
],

    /* =========================================================
     | DETAIL VIEW (Maximum context)
     ========================================================= */

    'detail' => [
    'consultation_date'      => 'Date',
    'name'                   => 'Name',
    'phone'                  => 'Phone',
    'consultation_type'      => 'Type',
    'channel'                => 'Channel',
    'consultant_label'       => 'Consultant',
    'referred_by'            => 'Referred By',
    'referred_to'            => 'Referred To',
    'consultation_fee'       => 'Fee',
    'followup_interval_days' => 'Follow-up Interval',
    'next_date'              => 'Next Date',
    'status_label'           => 'Status',
],

    /* =========================================================
     | SAMPLE EXPORT (Excel / CSV safe)
     ========================================================= */

    'sample_export' => [
        'consultation_date',
        'consultation_time',
        'name',
        'phone',
        'consultation_type',
        'channel',
        'consultant_label',
        'consultation_fee',
        'referred_by',
        'referred_to',
        'next_date',
        'status',
    ],

    /* =========================================================
     | USER SELECTABLE COLUMNS
     ========================================================= */

    'selectable' => [
        'consultation_date',
        'consultation_time',
        'name',
        'phone',
        'consultation_type',
        'channel',
        'consultant_label',
        'consultation_fee',
        'referred_by',
        'referred_to',
        'next_date',
        'status',
    ],
],

    // Cron Jobs / Documents
    'crons' => [
        'consultation-visitreminder' => 'Consultation Visit Reminder',
    ],

	// Documents
    'documents' => [
        'consultation-slip' => 'Consultation Slip'
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
