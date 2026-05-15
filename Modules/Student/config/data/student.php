<?php

use Modules\Shared\Support\KeyName;
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

			Actions::LIST => [
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

			Actions::DETAIL => [
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

			Actions::REPORT => [
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

			Actions::SAMPLE_EXPORT => [
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

			Actions::SELECTABLE => [
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

		KeyName::make(Res::FEE_STRUCTURE_PATTERNS) => [

		    Actions::LIST => [
		        'id'                => 'ID',
		        'name'              => 'Pattern Name',
		        'key'               => 'Key',
		        'description'       => 'Description',
		        'periods_count'     => 'Periods',
		        'is_customizable'   => 'Customizable',
		        'is_active'         => 'Active',
		        'sort_order'        => 'Order',
    		],

		    Actions::DETAIL => [
		        'id'                => 'ID',
		        'name'              => 'Pattern Name',
        		'key'               => 'Key',
		        'description'       => 'Description',
        		'periods_count'     => 'Total Periods',
		        'is_customizable'   => 'Customizable',
        		'is_active'         => 'Active',
		        'sort_order'        => 'Sort Order',
        		'created_at'        => 'Created',
		        'updated_at'        => 'Updated',
    		],

		    Actions::REPORT => [
		        'name'              => 'Pattern Name',
		        'key'               => 'Key',
		        'periods_count'     => 'Periods',
		        'is_customizable'   => 'Customizable',
		        'is_active'         => 'Active',
    		],

		    Actions::SAMPLE_EXPORT => [
		        'name',
		        'key',
		        'description',
		        'periods_count',
		        'is_customizable',
		        'is_active',
    		],

		    Actions::SELECTABLE => [
		        'name',
		        'key',
		        'periods_count',
		        'is_customizable',
		        'is_active',
    		],
		],

		KeyName::make(Res::FEE_COLLECTIONS) => [

			Actions::LIST => [
				'id'					=> 'ID',
				'student_name'			=> 'Student',
				'academic_year_name'	=> 'Session',
				'class_name'			=> 'Class',
				'section_name'			=> 'Section',
				'payment_mode_label'	=> 'Payment Mode',
				'gross_amount' 			=> 'Gross Amount',
				'discount_amount' 		=> 'Discount',
				'fine_amount' 			=> 'Fine',
				'paid_amount' 			=> 'Paid Amount',
				'balance_amount' 		=> 'Balance',
				'paid_at'				=> 'Payment Date',
				'status'				=> 'Status',
			],

			Actions::DETAIL => [
				'id'					=> 'ID',
				'student_name'			=> 'Student',
				'admission_no'			=> 'Admission No',
				'academic_year_name'	=> 'Session',
				'class_name'			=> 'Class',
				'section_name'			=> 'Section',
				'payment_mode_label'	=> 'Payment Mode',
				'gross_amount' 			=> 'Gross Amount',
				'discount_amount' 		=> 'Discount',
				'fine_amount' 			=> 'Fine',
				'paid_amount' 			=> 'Paid Amount',
				'balance_amount' 		=> 'Balance',
				'paid_at'				=> 'Payment Date',
				'remarks'				=> 'Remarks',
				'status'				=> 'Status',
			],

			Actions::REPORT => [
				'id'					=> 'ID',
				'student_name'			=> 'Student',
				'academic_year_name'	=> 'Session',
				'class_name'			=> 'Class',
				'section_name'			=> 'Section',
				'payment_mode_label'	=> 'Payment Mode',
				'gross_amount' 			=> 'Gross Amount',
				'discount_amount' 		=> 'Discount',
				'fine_amount' 			=> 'Fine',
				'paid_amount' 			=> 'Paid Amount',
				'balance_amount' 		=> 'Balance',
				'paid_at'				=> 'Payment Date',
			],

			Actions::SAMPLE_EXPORT => [
				'id',
				'student_name',
				'class_name',
				'payment_mode_label',
				'paid_amount',
				'paid_at',
			],

			Actions::SELECTABLE => [
				'id',
				'student_name',
				'class_name',
				'payment_mode_label',
				'paid_amount',
				'paid_at',
			],
		],

		KeyName::make(Res::FEE_DUES) => [

			Actions::LIST => [
				'student_id'			=> 'ID',
				'student_name'			=> 'Student',
				'class_name'			=> 'Class',
				'section_name'			=> 'Section',
				'total_payable'			=> 'Total Fee',
				'total_paid'			=> 'Paid',
				'total_discount'		=> 'Discount',
				'due_amount'			=> 'Due'
			],

			Actions::DETAIL => [
				'student_id'			=> 'ID',
				'student_name'			=> 'Student',
				'admission_no'			=> 'Admission No',
				'class_name'			=> 'Class',
				'section_name'			=> 'Section',
				'total_payable'			=> 'Total Fee',
				'total_paid'			=> 'Paid',
				'total_discount'		=> 'Discount',
				'due_amount'			=> 'Due',
				'status'				=> 'Status',
			],

			Actions::REPORT => [
				'student_id'			=> 'ID',
				'student_name'			=> 'Student',
				'class_name'			=> 'Class',
				'section_name'			=> 'Section',
				'total_payable'			=> 'Total Fee',
				'total_paid'			=> 'Paid',
				'total_discount'		=> 'Discount',
				'due_amount'			=> 'Due',
			],

			Actions::SAMPLE_EXPORT => [
				'student_name',
				'class_name',
				'total_amount',
				'paid_amount',
				'due_amount'
			],

			Actions::SELECTABLE => [
				'student_name',
				'class_name',
				'total_amount',
				'paid_amount',
				'due_amount'
			],
		],

		KeyName::make(Res::FEE_DEFAULTERS) => [

			Actions::LIST => [
				'id'					=> 'ID',
				'name'			=> 'Student',
				'class_name'			=> 'Class',
				'section_name'			=> 'Section',
				'due_amount'			=> 'Due Amount',
				'due_days'				=> 'Due Days',
				'due_date'				=> 'Due Date',
			],

			Actions::DETAIL => [
				'id'					=> 'ID',
				'name'			=> 'Student',
				'admission_no'			=> 'Admission No',
				'class_name'			=> 'Class',
				'section_name'			=> 'Section',
				'installment_label'		=> 'Installment',
				'total_payable'			=> 'Total Fee',
				'due_amount'			=> 'Due',
				'due_days'				=> 'Due Days',
				'due_date'				=> 'Due Date',
			],

			Actions::REPORT => [
				'name'			=> 'Student',
				'class_name'			=> 'Class',
				'section_name'			=> 'Section',
				'installment_label'		=> 'Installment',
				'due_amount'			=> 'Due Amount',
				'due_days'				=> 'Due Days',
				'due_date'				=> 'Due Date',
			],

			Actions::SAMPLE_EXPORT => [
				'name',
				'class_name',
				'installment_label',
				'due_amount',
				'due_days',
				'due_date',
			],

			Actions::SELECTABLE => [
				'name',
				'class_name',
				'installment_label',
				'due_amount',
				'due_days',
				'due_date',
			],
		],

		KeyName::make(Res::FEE_DISCOUNTS) => [

			Actions::LIST => [
				'id'					=> 'ID',
				'name'					=> 'Name',
				'student_name'			=> 'Student',
				'year_name'				=> 'Year',
				'discount_type_label'	=> 'Discount Type',
				'discount_amount'		=> 'Discount Amount',
				'created_at'			=> 'Created',
			],

			Actions::DETAIL => [
				'id'					=> 'ID',
				'name'					=> 'Name',
				'student_name'			=> 'Student',
				'admission_no'			=> 'Admission No',
				'year_name'				=> 'Year',
				'discount_type_label'	=> 'Discount Type',
				'discount_amount'		=> 'Discount Amount',
				'remarks'				=> 'Remarks',
				'created_at'			=> 'Created',
			],

			Actions::REPORT => [
				'name'					=> 'Name',
				'student_name'			=> 'Student',
				'year_name'				=> 'Year',
				'discount_type_label'	=> 'Discount Type',
				'discount_amount'		=> 'Discount Amount',
			],

			Actions::SAMPLE_EXPORT => [
				'name',
				'class_name',
				'discount_type_label',
				'discount_amount',
			],

			Actions::SELECTABLE => [
				'name',
				'class_name',
				'discount_type_label',
				'discount_amount',
			],
		],

		KeyName::make(Res::ACADEMIC_YEARS) => [

			Actions::LIST => [
				'id'				=> 'ID',
				'name'				=> 'Academic Year',
				'start_year'		=> 'Start Year',
				'end_year'			=> 'End Year',
				'start_date'		=> 'Start Date',
				'end_date'			=> 'End Date',
				'is_active'			=> 'Active',
				'is_locked'			=> 'Locked',
			],

			Actions::DETAIL => [
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

			Actions::REPORT => [
				'name'				=> 'Academic Year',
				'start_year'		=> 'Start Year',
				'end_year'			=> 'End Year',
				'start_date'		=> 'Start Date',
				'end_date'			=> 'End Date',
				'is_active'			=> 'Active',
				'is_locked'			=> 'Locked',
			],

			Actions::SAMPLE_EXPORT => [
				'name',
				'start_year',
				'end_year',
				'start_date',
				'end_date',
				'is_active',
				'is_locked',
			],

			Actions::SELECTABLE => [
				'name',
				'start_year',
				'end_year',
				'start_date',
				'end_date',
				'is_active',
				'is_locked',
			],
		],
		KeyName::make(Res::FEE_OVERRIDES) => [
			Actions::LIST => [
				'id'					=> 'ID',
				'student_name'			=> 'Student',
				'class_name'			=> 'Class',
				'section_name'			=> 'Section',
				'year_name'				=> 'Year',
				'created_at'			=> 'Created',
			],
		]
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
