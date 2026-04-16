<?php
$pg = 'employee';

return [

	// Bulk Operations
    "bulk-operations" => [
        "document:offer-letter"              => "Print Offer Letter",
        "document:employer-bond"             => "Print Employer Bond",
        "document:appointment-letter"        => "Print Appointment Letter",
        "document:salary-increment-letter"   => "Print Salary Increment Letter",
        "document:relieving-letter"          => "Print Relieving Letter",
        "document:experience-certificate"    => "Print Experience Certificate",
        "document:internship-certificate"    => "Print Internship Certificate",
        "document:employee-id-card"          => "Print ID Card",
        "send:email"                         => "Send Email",
        "send:sms"                           => "Send SMS",
        "op:remove"                          => "Delete",
        "op:restore"                         => "Restore"
    ],

	// Crons
	"crons" => [
        'employee-birthday' => 'Employee Birthday Message'
    ],

	// Documents
	'documents' => [
	    'offer-letter'              => 'Offer Letter',
    	'employer-bond'             => 'Employer Bond',
	    'appointment-letter'        => 'Appointment Letter',
    	'salary-increment-letter'   => 'Salary Increment Letter',
	    'promotion-letter'          => 'Promotion Letter',
    	'relieving-letter'          => 'Relieving Letter',
	    'experience-certificate'    => 'Experience Certificate',
		'internship-certificate'    => 'Internship Certificate',
    	'salary-slip'               => 'Salary Slip',
    	'id-card'                   => 'ID Card',
	],

	// Default Columns
	"columns" => [
        'entry'   => ['id','name','employee_type','designation','address','dob','status'],
        'list'    => ['id','name','employee_type','designation','address','dob','status'],
        'detail'  => ['id','name','employee_type','designation','address','dob','status'],
        'report'  => ['id','name','employee_type','designation','address','dob','status'],
        'sample_export' => ['sno','name','employee_type','designation','address','dob','phone','email'],
        'selected_columns' => ['name','employee_type','designation','address','dob','phone','email']
    ],

	// Uploads
	'uploads' => [
		'image' => 'Employee Image',
		'resume' => 'Resume / CV',
	    'aadhaar_card' => 'Aadhaar Card / ID Proof',
    	'pan_card' => 'PAN Card',
    	'address_proof' => 'Address Proof',
	    'educational_certificates' => 'Educational Certificates',
    	'experience_certificates' => 'Experience Certificates',
    	'appointment_letter' => 'Appointment Letter',
	    'salary_structure' => 'Salary Structure Document',
    	'medical_fitness_certificate' => 'Medical Fitness Certificate',
    	'police_verification' => 'Police Verification Document',
    	'bank_details' => 'Bank Details (Cancelled Cheque)',
	],

	// Statuses
	'statuses' => [
        '1'  => 'Active',
        '11' => 'Draft',
        '2'  => 'Deleted',
        '21' => 'Departed'
    ],

];
