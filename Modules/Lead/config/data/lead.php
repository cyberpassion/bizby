<?php
$pg = 'lead';

return [

	// Bulk Operations
    "bulk-operations" => [
        "view:detail" => "View Lead Details",
        "send:email"  => "Send Email",
        "send:sms"    => "Send SMS",
        "op:remove"   => "Delete Lead",
        "op:restore"  => "Restore Lead"
    ],

	// Default Columns
    "columns" => [
       'list' => [
    'lead_code'            => 'Code',
    'name'                 => 'Name',
    'contact_person'       => 'Person',
    'mobile'               => 'Mobile',
	'business_type'       => 'Business',
    'stage_id_label'       => 'Stage',
    'next_followup_date'   => 'Next Follow-up',
    'status_label'       => 'Status',
],
        'detail' => [
    'lead_code'            => 'Code',
    'name'                 => 'Name',
    'contact_person'       => 'Person',
    'mobile'               => 'Mobile',
	'business_type'       => 'Business',
    'stage_id_label'       => 'Stage',
    'next_followup_date'   => 'Next Follow-up',
	'followups'				=> 'Followups',
    'status_label'       => 'Status',
],
        'report' => [
    'lead_code'          => 'Code',
    'name'               => 'Name',
    'contact_person'     => 'Person',
    'mobile'             => 'Mobile',
	'business_type'       => 'Business Type',
    'stage_id_label'           => 'Stage',
    'next_followup_date' => 'Next Follow-up',
    'status_label'             => 'Status',
],
        'sample_export' => ['sno','potential_client_name','potential_client_mobile_number','potential_client_email','contact_by','expectation','next_date','contact_response','state','district','potential_client_address'],
        'selected_columns' => ['potential_client_name','potential_client_mobile_number','potential_client_email','contact_by','expectation','next_date','contact_response','state','district','potential_client_address']
    ],

	// Crons
	"crons" => [
        'lead-followupreminders' => 'Lead Upcoming Followups'
    ],

	// Statuses
    "statuses" => [
        "1"  => "PROGRESS",
        "12" => "CLOSED",
        "19" => "LOST",
        "2"  => "DELETED",
        "11" => "NC"
    ],

	/* =========================
     | CUSTOM SPECIFIC FOR MODULE
     ========================= */

	// Lead contact after
    "lead-contact-after" => [
        "1 days"=>"1 Day",
        "4 days"=>"4 Days",
        "7 days"=>"7 Days",
        "15 days"=>"15 Days",
        "30 days"=>"1 Month",
        "60 days"=>"2 Months",
        "90 days"=>"3 Months",
        "180 days"=>"6 Months",
        "365 days"=>"1 Year"
    ],

];
