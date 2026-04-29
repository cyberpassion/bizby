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
     | LIST VIEW
     ========================================================= */
    'list' => [
    'incident_code'    => 'Incident Code',
    'center_id_label'  => 'Center',
    'type_label'       => 'Type',
    'location'         => 'Location',
    'severity_label'   => 'Severity',
    'incident_date'    => 'Incident Date',
    'incident_time'    => 'Incident Time',
    'status_label'     => 'Status',
],

    /* =========================================================
     | REPORT VIEW
     ========================================================= */
    'report' => [
    'incident_code'    => 'Incident Code',
    'center_id_label'  => 'Center',
    'type_label'       => 'Type',
    'location'         => 'Location',
    'severity_label'   => 'Severity',
    'incident_date'    => 'Incident Date',
    'incident_time'    => 'Incident Time',
    'status_label'     => 'Status',
],

    /* =========================================================
     | DETAIL VIEW
     ========================================================= */
    'detail' => [

    /* CORE */
    'id'               => 'ID',
    'incident_code'    => 'Incident Code',

    /* RELATION */
    'center_id'        => 'Center ID',
    'center_id_label'  => 'Center',

    /* INCIDENT INFO */
    'type_label'       => 'Type',
    'location'         => 'Location',
    'severity'         => 'Severity Code',
    'severity_label'   => 'Severity',

    /* TIMING */
    'incident_date'    => 'Incident Date',
    'incident_time'    => 'Incident Time',

    /* REPORTING */
    'reporter_name'         => 'Reported By',

    /* STATUS */
    'status_label'           => 'Status',
    'status_label'     => 'Status',

    /* SYSTEM */
    'created_at'       => 'Created At',
    'updated_at'       => 'Updated At',
],

    /* =========================================================
     | EXPORT
     ========================================================= */
    'sample_export' => [
        'incident_code',
        'center_id_label',
        'type',
        'location',
        'severity_label',
        'incident_date',
        'incident_time',
        'status_label'
    ],

    /* =========================================================
     | SELECTABLE
     ========================================================= */
    'selectable' => [
        'incident_code',
        'center_id_label',
        'type',
        'severity_label',
        'incident_date',
        'status_label'
    ],
],

    // Cron Jobs / Documents
    'crons' => [
        'incident-visitreminder' => 'Incident Visit Reminder',
    ],

	// Documents
    'documents' => [
        'incident-slip'		=> 'Incident Slip',
		'incident-report'	=> 'Incident Report'
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

	'log_events' => [
    	'acknowledged' => 'Acknowledged',
    	'assigned'     => 'Assigned',
    	'reassigned'   => 'Reassigned',
    	'updated'      => 'Updated',
    	'comment'      => 'Comment',
    	'escalated'    => 'Escalated',
    	'deescalated'  => 'De-escalated',
    	'resolved'     => 'Resolved',
    	'reopened'     => 'Reopened',
	]

];
