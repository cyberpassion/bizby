<?php

use Modules\Shared\Support\UrlPath;
use Modules\Shared\Support\KeyName;
use Modules\Shared\Support\Permission;
use Modules\Student\Support\Res;
use Modules\Student\Support\Actions;

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
    "columns" => [

	KeyName::make(Res::STUDENTS) => [

		'list' => [
			'id'					=> 'ID',
			'name'					=> 'Student Name',
			'father_name'			=> 'Father',
			'dob'					=> 'DOB',
			'phone'					=> 'Phone',
			'class_name'			=> 'Class',
			'section_name'			=> 'Section',
			'academic_year_name'	=> 'Session',
			'gender'				=> 'Gender',
			'status'				=> 'Status',
		],

		'detail' => [
			'id'					=> 'ID',
			'name'					=> 'Student Name',
			'father_name'			=> 'Father Name',
			'mother_name'			=> 'Mother Name',
			'class_name'			=> 'Class',
			'section_name'			=> 'Section',
			'academic_year_name'	=> 'Session',
			'gender'				=> 'Gender',
			'category_label'		=> 'Category',
			'caste_label'			=> 'Caste',
			'date_of_birth'			=> 'DOB',
			'email'					=> 'Email',
			'address'				=> 'Address',
			'status'				=> 'Status',
			'created_at'			=> 'Created',
		],

		'report' => [
			'id'					=> 'ID',
			'name'					=> 'Student Name',
			'father_name'			=> 'Father',
			'dob'					=> 'DOB',
			'phone'					=> 'Phone',
			'class_name'			=> 'Class',
			'section_name'			=> 'Section',
			'academic_year_name'	=> 'Session',
			'gender'				=> 'Gender',
			'category_label'		=> 'Category',
			'caste_label'			=> 'Caste',
			'status'				=> 'Status',
		],

		'sample_export' => [
			'name',
			'admission_no',
			'roll_no',
			'class_name',
			'section_name',
			'academic_year_name',
			'gender',
			'mobile',
			'status',
		],

		'selected_columns' => [
			'name',
			'admission_no',
			'roll_no',
			'class_name',
			'section_name',
			'academic_year_name',
			'gender',
			'mobile',
			'status',
		],
	],

	KeyName::make(Res::FEE_COLLECTIONS) => [

		'list' => [
			'id'					=> 'ID',
			'receipt_no'			=> 'Receipt No',
			'student_name'			=> 'Student',
			'class_name'			=> 'Class',
			'payment_mode_label'	=> 'Payment Mode',
			'amount_received'		=> 'Amount',
			'payment_date'			=> 'Payment Date',
			'status'				=> 'Status',
		],

		'detail' => [
			'id'					=> 'ID',
			'receipt_no'			=> 'Receipt No',
			'student_name'			=> 'Student',
			'admission_no'			=> 'Admission No',
			'class_name'			=> 'Class',
			'section_name'			=> 'Section',
			'payment_mode_label'	=> 'Payment Mode',
			'total_amount'			=> 'Total Amount',
			'total_discount'		=> 'Discount',
			'amount_received'		=> 'Amount Received',
			'payment_date'			=> 'Payment Date',
			'remarks'				=> 'Remarks',
			'status'				=> 'Status',
		],

		'report' => [
			'receipt_no'			=> 'Receipt No',
			'student_name'			=> 'Student',
			'class_name'			=> 'Class',
			'section_name'			=> 'Section',
			'payment_mode_label'	=> 'Payment Mode',
			'amount_received'		=> 'Amount Received',
			'payment_date'			=> 'Payment Date',
		],

		'sample_export' => [
			'receipt_no',
			'student_name',
			'class_name',
			'payment_mode_label',
			'amount_received',
			'payment_date',
		],

		'selected_columns' => [
			'receipt_no',
			'student_name',
			'class_name',
			'payment_mode_label',
			'amount_received',
			'payment_date',
		],
	],

	KeyName::make(Res::FEE_DUES) => [

		'list' => [
			'id'					=> 'ID',
			'name'			=> 'Student',
			'class_name'			=> 'Class',
			'section_name'			=> 'Section',
			'total_amount'			=> 'Total Fee',
			'amount_received'		=> 'Paid',
			'due_amount'			=> 'Due',
			'due_date'				=> 'Due Date',
		],

		'detail' => [
			'id'					=> 'ID',
			'name'			=> 'Student',
			'admission_no'			=> 'Admission No',
			'class_name'			=> 'Class',
			'section_name'			=> 'Section',
			'total_amount'			=> 'Total Fee',
			'total_discount'		=> 'Discount',
			'amount_received'		=> 'Paid',
			'due_amount'			=> 'Due',
			'due_date'				=> 'Due Date',
			'status'			=> 'Status',
		],

		'report' => [
			'name'			=> 'Student',
			'class_name'			=> 'Class',
			'section_name'			=> 'Section',
			'total_amount'			=> 'Total Fee',
			'amount_received'		=> 'Paid',
			'due_amount'			=> 'Due',
			'due_date'				=> 'Due Date',
		],

		'sample_export' => [
			'name',
			'class_name',
			'total_amount',
			'amount_received',
			'due_amount',
			'due_date',
		],

		'selected_columns' => [
			'name',
			'class_name',
			'total_amount',
			'amount_received',
			'due_amount',
			'due_date',
		],
	],

	KeyName::make(Res::FEE_DEFAULTERS) => [

		'list' => [
			'id'					=> 'ID',
			'name'			=> 'Student',
			'class_name'			=> 'Class',
			'section_name'			=> 'Section',
			'due_amount'			=> 'Due Amount',
			'due_days'				=> 'Due Days',
			'due_date'				=> 'Due Date',
		],

		'detail' => [
			'id'					=> 'ID',
			'name'			=> 'Student',
			'admission_no'			=> 'Admission No',
			'class_name'			=> 'Class',
			'section_name'			=> 'Section',
			'installment_label'		=> 'Installment',
			'total_amount'			=> 'Total Fee',
			'amount_received'		=> 'Paid',
			'due_amount'			=> 'Due Amount',
			'due_days'				=> 'Due Days',
			'due_date'				=> 'Due Date',
		],

		'report' => [
			'name'			=> 'Student',
			'class_name'			=> 'Class',
			'section_name'			=> 'Section',
			'installment_label'		=> 'Installment',
			'due_amount'			=> 'Due Amount',
			'due_days'				=> 'Due Days',
			'due_date'				=> 'Due Date',
		],

		'sample_export' => [
			'name',
			'class_name',
			'installment_label',
			'due_amount',
			'due_days',
			'due_date',
		],

		'selected_columns' => [
			'name',
			'class_name',
			'installment_label',
			'due_amount',
			'due_days',
			'due_date',
		],
	],

	KeyName::make(Res::FEE_DISCOUNTS) => [

		'list' => [
			'id'					=> 'ID',
			'name'			=> 'Student',
			'class_name'			=> 'Class',
			'discount_type_label'	=> 'Discount Type',
			'discount_amount'		=> 'Discount Amount',
			'created_at'			=> 'Created',
		],

		'detail' => [
			'id'					=> 'ID',
			'name'			=> 'Student',
			'admission_no'			=> 'Admission No',
			'class_name'			=> 'Class',
			'section_name'			=> 'Section',
			'discount_type_label'	=> 'Discount Type',
			'discount_amount'		=> 'Discount Amount',
			'remarks'				=> 'Remarks',
			'created_at'			=> 'Created',
		],

		'report' => [
			'name'			=> 'Student',
			'class_name'			=> 'Class',
			'section_name'			=> 'Section',
			'discount_type_label'	=> 'Discount Type',
			'discount_amount'		=> 'Discount Amount',
		],

		'sample_export' => [
			'name',
			'class_name',
			'discount_type_label',
			'discount_amount',
		],

		'selected_columns' => [
			'name',
			'class_name',
			'discount_type_label',
			'discount_amount',
		],
	],

	KeyName::make(Res::ACADEMIC_YEARS) => [

	'list' => [
		'id'				=> 'ID',
		'name'				=> 'Academic Year',
		'start_year'		=> 'Start Year',
		'end_year'			=> 'End Year',
		'start_date'		=> 'Start Date',
		'end_date'			=> 'End Date',
		'is_active'			=> 'Active',
		'is_locked'			=> 'Locked',
	],

	'detail' => [
		'id'				=> 'ID',
		'name'				=> 'Academic Year',
		'start_year'		=> 'Start Year',
		'end_year'			=> 'End Year',
		'start_date'		=> 'Start Date',
		'end_date'			=> 'End Date',
		'is_active'			=> 'Active',
		'is_locked'			=> 'Locked',
		'description'		=> 'Description',
		'created_at'		=> 'Created',
		'updated_at'		=> 'Updated',
	],

	'report' => [
		'name'				=> 'Academic Year',
		'start_year'		=> 'Start Year',
		'end_year'			=> 'End Year',
		'start_date'		=> 'Start Date',
		'end_date'			=> 'End Date',
		'is_active'			=> 'Active',
		'is_locked'			=> 'Locked',
	],

	'sample_export' => [
		'name',
		'start_year',
		'end_year',
		'start_date',
		'end_date',
		'is_active',
		'is_locked',
	],

	'selected_columns' => [
		'name',
		'start_year',
		'end_year',
		'start_date',
		'end_date',
		'is_active',
		'is_locked',
	],
],
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
