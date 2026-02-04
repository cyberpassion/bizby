<?php
$pg = 'employee';

return [

    'employee.statuses' => [
        '1'  => 'Active',
        '11' => 'Draft',
        '2'  => 'Deleted',
        '21' => 'Departed'
    ],

    "employee.crons" => [
        'employee-birthday' => 'Employee Birthday Message'
    ],

    "employee.bulk-operations" => [
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

    "employee.default-columns" => [
        'entry'   => ['employee_id','employee_name','employee_type','designation','permanent_address','dob','tags','status'],
        'list'    => ['employee_id','employee_name','employee_type','designation','permanent_address','dob','tags','status'],
        'detail'  => ['employee_id','employee_name','employee_type','designation','permanent_address','dob','tags','status'],
        'report'  => ['employee_id','employee_name','employee_type','designation','permanent_address','dob','tags','status'],
        'sample_export' => ['sno','employee_name','employee_type','designation','permanent_address','dob','phone_number','email_id'],
        'selected_columns' => ['employee_name','employee_type','designation','permanent_address','dob','phone_number','email_id']
    ],

    "employee.documents" => [
        'offer-letter'              => 'Offer Letter',
        'employer-bond'             => 'Employer Bond',
        'appointment-letter'        => 'Appointment Letter',
        'salary-increment-letter'   => 'Salary Increment Letter',
        'promotion-letter'          => 'Promotion Letter',
        'relieving-letter'          => 'Relieving Letter',
        'experience-certificate'    => 'Experience Certificate',
        'internship-certificate'    => 'Internship Certificate',
        'employee-id-card'          => 'ID Card'
    ],

    "communicationTemplate-employee" => [
        "employee_entry_new_sms"        => "New Employee Entry SMS",
        "employee_entry_new_whatsapp"   => "New Employee Entry Whatsapp",
        "employee_entry_new_email"      => "New Employee Entry Email",
        "employee_salary_new_sms"       => "New Employee Salary SMS",
        "employee_salary_new_whatsapp"  => "New Employee Salary Whatsapp",
        "employee_salary_new_email"     => "New Employee Salary Email",
        "employee_birthday_new_sms"     => "Employee Birthday SMS",
        "employee_birthday_new_whatsapp"=> "Employee Birthday Whatsapp",
        "employee_birthday_new_email"   => "Employee Birthday Email",
    ],

    "columnNameMapping-employee" => [
        'employee_id'        => 'ID',
        'employee_name'      => 'Name',
        'employee_type'      => 'Type',
        'designation'        => 'Designation',
        'date_of_joining'    => 'Joining Date'
    ],

    "mandatoryFields-employee-entry-update" => ['employee_name','phone_number'],

    "dateFields-employee-entry-update" => ['dob','date','date_of_joining','date_of_relieving'],

    "jsonFields-employee-entry-update" => [
        'qualifications',
        'job_responsibility',
        'teaching_subjects',
        'teaching_classes',
        'announcement_permission',
        'attendance_permission'
    ],

    "moduleTable-employee" => [
        "terms",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "uploads",
        "cyp_notification",
        "cyp_message",
        "employees"
    ],

    "interactiveEntity-employee" => ['employee'],

];
