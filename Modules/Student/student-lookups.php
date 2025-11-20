<?php

$pg = 'student';

return [
    // Communication Templates
    "communicationTemplate-student" => [
        "student_entry_new_sms"             => "New Student Entry SMS",
        "student_entry_new_whatsapp"       => "New Student Entry Whatsapp",
        "student_entry_new_email"          => "New Student Entry Email",
        "student_feesubmission_new_sms"    => "New Student Fee Submission SMS",
        "student_feesubmission_new_whatsapp"=> "New Student Fee Submission Whatsapp",
        "student_feesubmission_new_email"  => "New Student Fee Submission Email",
        "student_feereminder_new_sms"      => "New Student Fee Reminder SMS",
        "student_feereminder_new_whatsapp" => "New Student Fee Reminder Whatsapp",
        "student_feereminder_new_email"    => "New Student Fee Reminder Email",
        "student_birthday_new_sms"         => "Student Birthday SMS",
        "student_birthday_new_whatsapp"    => "Student Birthday Whatsapp",
        "student_birthday_new_email"       => "Student Birthday Email"
    ],

    // Column Name Mapping
    "columnNameMapping-student" => [
        'admission_id'               => 'ID',
        'student_name'               => 'Name',
        'father_name'                => 'F/Name',
        'mother_name'                => 'M/Name',
        'phone_number'               => 'Phone',
        'admission_class'            => 'Adm. Class',
        'admission_section'          => 'Adm. Section',
        'admission_session'          => 'Adm. Session',
        'current_class'              => 'Class',
        'current_section'            => 'Section',
        'current_session'            => 'Session',
        'admission_datetime'         => 'Adm. Datetime',
        'admission_date'             => 'Adm. Date',
        'father_phone_number'        => 'F/Phone',
        'reference_name'             => 'Reference',
        'transport_pickup_stop'      => 'Bus Stop',
        'class_roll_no'              => 'Roll No',
        'board_roll_no'              => 'Board Roll No',
        'sr_no'                      => 'Sr',
        'documents_submitted'        => 'Documents',
        'transport_pickup_location'  => 'Pickup Stop',
        'transport_vehicle_id'       => 'Vehicle',
        'registration_datetime'      => 'Reg Datetime'
    ],

    // Module Tables
    "moduleTable-student" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_student"
    ],

    // Default Columns
    "defaultColumns-student" => [
        'entry'          => ['admission_id','student_name','father_name','phone_number','current_class','current_section','permanent_address','tags','status'],
        'list'           => ['admission_id','student_name','father_name','phone_number','current_class','current_section','permanent_address','tags','status'],
        'detail'         => ['admission_id','student_name','father_name','phone_number','current_class','current_section','permanent_address','tags','status'],
        'report'         => ['admission_id','student_name','father_name','phone_number','current_class','current_section','permanent_address','status'],
        'sample_export'  => ['sno','student_name','father_name','phone_number','admission_class','admission_section','admission_session','current_class','current_section','current_session','permanent_address'],
        'selected_columns'=> ['student_name','father_name','phone_number','admission_class','admission_section','admission_session','current_class','current_section','current_session','permanent_address'],
        'day-report'     => ['admission_id','student_name','father_name','phone_number','dob','status'],
        'dues-report'    => ['admission_id','student_name','father_name','phone_number','permanent_address','dob','status']
    ],

    // Mandatory Fields
    "mandatoryFields-student_entry" => ['student_name','phone_number'],

    // Date Fields
    "dateFields-student_entry" => ['admission_date','caste_date','income_date','dob'],

    // JSON Fields
    "jsonFields-student_entry" => ['subjects','documents_submitted'],

    // Interactive Entity
    "interactiveEntity-student" => ['student'],

    // Student Status
    "student_status-json" => [
        '1'  => 'Active',
        '11' => 'Draft',
        '19' => 'Promoted',
        '2'  => 'Deleted',
        '21' => 'TC Generated',
        '22' => 'Departed w/o TC',
        '23' => 'Rusticated',
        '2x' => 'Deleted (Other Reasons)',
        '127'=> 'Cancelled'
    ],

    // Institute Types
    "student_institute_type-json" => ['school','college','coaching','university'],

    // Resident Types
    "student_resident_type-json" => ['day-scholar'=>'Day Scholar','hosteler'=>'Hosteler']
];
