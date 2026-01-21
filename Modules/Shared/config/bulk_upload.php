
<?php
return [
    'tables' => [

        /* =======================
         |  STUDENTS
         ======================= */
        'students' => [
            'columns' => [
                'admission_number',
                'admission_date',
                'name',
                'gender',
                'dob',
                'phone',
                'email',
                'address',
                'father_name',
                'mother_name',
            ],
            'required' => [
                'name',
                'admission_number',
            ],
            'defaults' => [
                'status' => 1,
            ],
        ],

        /* =======================
         |  EMPLOYEES
         ======================= */
        'employees' => [
            'columns' => [
                'employee_type',
                'designation',
                'date_of_joining',
                'punch_id',
                'job_location',
                'name',
                'gender',
                'dob',
                'phone',
                'email',
                'address',
                'spouse_name',
                'qualification_level',
                'educational_qualification',
                'professional_qualification',
                'qualifications',
                'past_work_experience',
                'teaching_exam_qualified',
                'pan_number',
                'aadhar_number',
                'pf_account_number',
                'bank_name',
                'bank_branch_name',
                'bank_ifsc_code',
                'bank_account_number',
                'first_salary',
                'current_salary',
            ],
            'required' => [
                'name',
                'employee_type',
                'designation',
                'date_of_joining',
            ],
            'defaults' => [
                'status' => 1,
            ],
        ],

        /* =======================
         |  CUSTOMERS
         ======================= */
        'customers' => [
            'columns' => [
                'business_type',
                'customer_type',
                'name',
                'gender',
                'dob',
                'phone',
                'email',
                'address',
                'reference',
                'next_date',
                'state',
                'district',
                'gstin',
            ],
            'required' => [
                'name',
                'phone',
            ],
            'defaults' => [
                'status' => 1,
            ],
        ],

        /* =======================
         |  VENDORS
         ======================= */
        'vendors' => [
            'columns' => [
                'vendor_type',
                'vendor_code',
                'vendor_parent_id',
                'name',
                'gender',
                'dob',
                'phone',
                'email',
                'address',
                'vendor_gstin',
                'vendor_pan',
                'vendor_info',
                'vendor_bank_info',
                'vendor_terms_and_condition',
                'vendor_person',
                'vendor_person_designation',
                'vendor_person_phone',
                'vendor_person_email',
                'region',
                'state',
                'district',
                'sales',
                'thread_parent',
                'incentive_percentage',
            ],
            'required' => [
                'name',
            ],
            'defaults' => [
                'status' => 1,
            ],
        ],

        /* =======================
         |  REGISTRATIONS
         ======================= */
        'registrations' => [
            'columns' => [
                'type',                 // admission, affiliation, exam, scholarship
                'registration_status',  // draft, submitted, approved
                'submitted_at',
            ],
            'required' => [
                'type',
            ],
            'defaults' => [
                'registration_status' => 'draft',
                'status' => 1,
            ],
        ],

        /* =======================
         |  CONSULTATIONS
         ======================= */
        'consultations' => [
            'columns' => [
                'consultation_group_id',
                'consultation_date',
                'consultation_time',
                'day_token_id',
                'channel',

                // Person info
                'name',
                'gender',
                'dob',
                'phone',
                'email',
                'address',

                // Consultation details
                'consultation_type',
                'consultation_fee',
                'reason',
                'referred_by',
                'referred_to',
                'followup_interval_days',
                'next_date',
                'thread_parent',
            ],
            'required' => [
                'name',
                'consultation_date',
            ],
            'defaults' => [
                'status' => 1,
            ],
        ],

        /* =======================
         |  LEADS
         ======================= */
        'leads' => [
            'columns' => [
                'lead_code',
                'name',
                'contact_person',
                'mobile',
                'email',
                'district',
                'state',
                'pincode',
                'website',
                'category_id',
                'source_id',
                'stage_id',
                'is_existing_client',
                'place',
                'next_followup_date',
                'thread_parent_id',
            ],
            'required' => [
                'name',
                'mobile',
            ],
            'defaults' => [
                'status' => 1,
                'is_existing_client' => false,
            ],
        ],
    ],
];
