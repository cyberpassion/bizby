<?php

$pg = 'student';

return [

	// Bulk Operations
    'bulk-operations' => [
        'document:admission-form'       => 'Print Admission Form',
        'document:id-card'              => 'Print ID Card',
        'document:bonafide-certificate' => 'Print Bonafide Certificate',
        'document:transfer-certificate' => 'Print Transfer Certificate',
        'send:email'                    => 'Send Email',
        'send:sms'                      => 'Send SMS',
        'student:promote'               => 'Promote Student(s)',
        'student:demote'                => 'Demote Student(s)',
        'op:remove'                     => 'Delete',
        'op:restore'                    => 'Restore',
    ],

	// Default Columns
    'columns' => [
        'list'				=> [ 'id', 'name', 'father_name', 'phone', 'status' ],
		'report'			=> [ 'id', 'name', 'father_name', 'phone', 'status' ],
		'detail'			=> [ 'id', 'name', 'father_name', 'phone', 'status' ],
		'report'			=> [ 'id', 'name', 'father_name', 'phone', 'status' ],
		'sample_export'		=> [ 'id', 'name', 'father_name', 'phone', 'status' ],
		'selected-columns'	=> [ 'id', 'name', 'father_name', 'phone', 'status' ],
    ],

	// Documents
	'documents' => [
	    'activity_undertaking'   => 'Activity Undertaking',
    	'admission_form'         => 'Admission Form',
	    'admit_card'             => 'Admit Card',
    	'bonafide_certificate'   => 'Bonafide Certificate',
	    'dob_certificate'        => 'DOB Certificate',
    	'character_certificate'  => 'Character Certificate',
	    'fee_slip'               => 'Fee Slip',
    	'fee_certificate'        => 'Fee Certificate',
    	'id_card'                => 'ID Card',
	    'medical_certificate'    => 'Medical Certificate',
    	'transfer_certificate'   => 'Transfer Certificate',
    	'fee_structure'          => 'Fee Structure',
	],

    'document_upload_types' => [
        'principal-signature' => 'Principal Signature',
        'cashier-signature'   => 'Cashier Signature',
        'fee-structure'       => 'Fee Structure Excel',
    ],

	// Statuses
    'statuses' => [
        '1'   => 'Active',
        '11'  => 'Draft',
        '19'  => 'Promoted',
        '2'   => 'Deleted',
        '21'  => 'TC Generated',
        '22'  => 'Departed w/o TC',
        '23'  => 'Rusticated',
        '2x'  => 'Deleted (Other Reasons)',
        '127' => 'Cancelled',
    ],

	// Uploads
	'uploads' => [
		'image' => 'Student Photograph',
		'father_image' => 'Father Photograph',
		'mother_image' => 'Mother Photograph',
	    'aadhaar_card' => 'Aadhaar Card / ID Proof',
    	'birth_certificate' => 'Birth Certificate',
    	'address_proof' => 'Address Proof',
	    'previous_marksheets' => 'Previous Class Mark Sheets',
    	'transfer_certificate' => 'Transfer Certificate (TC)',
    	'migration_certificate' => 'Migration Certificate',
    	'character_certificate' => 'Character Certificate',
    	'medical_certificate' => 'Medical Certificate',
    	'caste_certificate' => 'Caste Certificate (if applicable)',
    	'income_certificate' => 'Income Certificate (if applicable)',
    	'passport_photo_parent' => 'Parent/Guardian Photograph',
    	'parent_id_proof' => 'Parent/Guardian ID Proof',
	],

];
