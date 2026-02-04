<?php
$pg = 'examresult';

return [

    /* =========================
     | Filters (Admin / Portal)
     ========================= */
    "examresult.list-filters" => [
        "admin" => [
            'session' => "Session/exam_session/session-json",
            'class'   => "Class/exam_class/class-json",
            'status'  => "Status/status/status-json",
        ],
        "portal" => [
            'session' => "Session/exam_session/session-json",
            'class'   => "Class/exam_class/class-json",
            'status'  => "Status/status/status-json",
        ]
    ],

    /* =========================
     | Bulk Operations
     ========================= */
    "examresult.bulk-operations" => [
        'examresult:single-report-card' => 'Print Report Card',
        'examresult:eoy-report-card'    => 'Print EOY Report Card',
        'op:delete'                     => 'Delete',
        'op:restore'                    => 'Restore'
    ],

    /* =========================
     | Default Columns
     ========================= */
    "examresult.default-columns" => [
        'entry'   => ['exam_id','exam_name','exam_class','exam_section','exam_session','tags','status'],
        'list'    => ['exam_id','exam_name','exam_class','exam_section','exam_session','tags','status'],
        'detail'  => ['exam_id','exam_name','exam_class','exam_section','exam_session','tags','status'],
        'report'  => ['exam_id','exam_name','exam_class','exam_section','exam_session','tags','status'],
        'sample_export' => ['sno','exam_name','exam_class','exam_section','exam_session'],
        'selected_columns' => ['exam_name','exam_class','exam_section','exam_session']
    ],

    /* =========================
     | Communication Templates
     ========================= */
    "communicationTemplate-examresult" => [
        "examresult_entry_new_sms"        => "New Examresult Entry SMS",
        "examresult_entry_new_whatsapp"   => "New Examresult Entry Whatsapp",
        "examresult_entry_new_email"      => "New Examresult Entry Email",
        "examresult_marks_new_sms"        => "New Examresult Marks SMS",
        "examresult_marks_new_whatsapp"   => "New Examresult Marks Whatsapp",
        "examresult_marks_new_email"      => "New Examresult Marks Email",
    ],

    /* =========================
     | Column Name Mapping
     ========================= */
    "columnNameMapping-examresult" => [
        'ptr'           => 'SNo',
        'exam_id'       => 'ID',
        'exam_name'     => 'Name',
        'exam_session'  => 'Session',
        'exam_class'    => 'Class',
        'exam_section'  => 'Section',
        'status'        => 'Status',
        'options'       => 'Options'
    ],

    /* =========================
     | Database Tables
     ========================= */
    "moduleTable-examresult" => [
        "terms",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "uploads",
        "cyp_notification",
        "cyp_message",
        "cyp_examresult",
        "cyp_examresult_mark"
    ],

    /* =========================
     | Mandatory Fields
     ========================= */
    "mandatoryFields-examresult-entry-update" => [
        'module',
        'examresult_official_name',
        'examresult_official_address',
        'examresult_official_email',
        'examresult_official_phone',
        'send_notification_message'
    ],

    /* =========================
     | Permissions
     ========================= */
    "permissionAdmin-examresult" => [
        'restricted'=> [
            '2' => [['pg'=>$pg,'sub_pg'=>'settings']],
            '3' => [['pg'=>$pg,'sub_pg'=>'settings']]
        ],
        'allowed'=>[]
    ],

    "permissionPortal-examresult" => [
        'restricted'=>[],
        'allowed'=>[
            ['pg'=>$pg,'sub_pg'=>'home'],
            ['pg'=>$pg,'sub_pg'=>'list'],
            ['pg'=>$pg,'sub_pg'=>'report-card'],
        ]
    ],

    "permissionAllowedFiltersPortal-module" => [
        "entry"  => [[ "exam_class" => '{$current_class}' ]],
        "list"   => [[ "exam_class" => '{$current_class}' ]],
        "report" => [[ "exam_class" => '{$current_class}' ]]
    ],

    /* =========================
     | Static Options
     ========================= */
    "examresult-sortby" => [
        "admission_id"=>"Admission ID",
        "student_name"=>"Name",
        "rank"=>"Rank"
    ],

    "examresult-display-type" => [
        "all-students"=>"All Students",
        "student-with-marks"=>"Student With Marks",
        "student-without-marks"=>"Student Without Marks"
    ],

    "performance-exam-result" => [
        "PASSED, FIRST DIVISION",
        "PASSED, SECOND DIVISION",
        "PASSED, THIRD DIVISION",
        "PASSED, FOURTH DIVISION",
        "FAILED"
    ],

    "examresult-report-type-list" => [
        "divisionwise-list"=>"Division-Wise List",
        "percentagewise-list"=>"Percentage-Wise List",
        "namewise-list"=>"Namewise List"
    ],

    "examresult-eoy-report-card-format-list" => [
        "cbse"=>"CBSE",
        "writtenoral"=>"Written & Oral",
        "sapa"=>"Subject Assessment & Periodic Assessment",
        "hy"=>"Half-Yearly & Annual"
    ],

];
