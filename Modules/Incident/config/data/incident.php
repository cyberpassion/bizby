<?php
$pg = 'incident';

return [

	// Bulk Operations
    'bulk-operations' => [
        'document:incident-slip' 	 => 'Print Incident Slip',
        'send:sms'                   => 'Send Incident SMS',
        'send:email'                 => 'Send Incident Email',
        'op:remove'                  => 'Delete Incident',
        'op:restore'                 => 'Restore Incident',
    ],

	// Default Columns
    'columns' => [

    /* =========================================================
     | LIST VIEW (Fast scanning, operational)
     ========================================================= */

    'list' => [
        'id',
        'center_id',
		'incident_code',
        'location',
        'severity',
        'incident_date',
		'incident_time',
        'status'
    ],

    /* =========================================================
     | REPORT VIEW (Business intelligence)
     ========================================================= */

    'report' => [
        'id',
        'center_id',
		'incident_code',
        'location',
        'severity',
        'incident_date',
		'incident_time',
        'status'
    ],

    /* =========================================================
     | DETAIL VIEW (Maximum context)
     ========================================================= */

    'detail' => [
        'id',
        'incident_group_id',
        'incident_date',
        'incident_time',
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

        'incident_type',
        'incident_fee',
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
        'incident_date',
        'incident_time',
        'name',
        'phone',
        'incident_type',
        'channel',
        'consultant',
        'incident_fee',
        'referred_by',
        'referred_to',
        'next_date',
        'status',
    ],

    /* =========================================================
     | USER SELECTABLE COLUMNS
     ========================================================= */

    'selectable' => [
        'incident_date',
        'incident_time',
        'name',
        'phone',
        'incident_type',
        'channel',
        'consultant',
        'incident_fee',
        'referred_by',
        'referred_to',
        'next_date',
        'status',
    ],
],

    // Cron Jobs / Documents
    'crons' => [
        'incident-visitreminder' => 'Incident Visit Reminder',
    ],

	// Documents
    'documents' => [
        'incident-slip' => 'Incident Slip'
    ],

	// Status
    'statuses' => [
	    '1' => 'Reported',
    	'2' => 'Under Review',
	    '3' => 'In Progress',
    	'4' => 'Resolved',
    	'5' => 'Closed',
    	'6' => 'Rejected'
	],

	// Uploads
    'uploads' => [
		'image' => 'Incident Image',
	    'incident_report_form' => 'Incident Report Form',
    	'fir_copy' => 'FIR Copy (if applicable)',
    	'incident_media' => 'Photos / Videos of Incident',
	    'damage_assessment_report' => 'Damage Assessment Report',
    	'response_team_report' => 'Response Team Report',
    	'insurance_claim_documents' => 'Insurance Claim Documents',
	    'witness_statements' => 'Witness Statements',
    	'investigation_report' => 'Investigation Report',
    	'final_closure_report' => 'Final Closure Report',
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

	// Severities
    'severities' => [
        'low'       => 'Low',
	    'medium'    => 'Medium',
    	'high'      => 'High',
    	'critical'  => 'Critical',
    ],

];
