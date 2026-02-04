<?php
$pg = 'leaveapplication';

return [

    /* =========================
     | Leave Types & Status
     ========================= */
    'leaveapplication.leave-type' => [
        'casual-leave'     => 'Casual Leave',
        'sick-leave'       => 'Sick Leave',
        'medical-leave'    => 'Medical Leave',
        'maternity-leave'  => 'Maternity Leave',
        'paternity-leave'  => 'Paternity Leave'
    ],

    'leaveapplication.statuses' => [
        '1'  => 'In-Review',
        '10' => 'Accepted',
        '11' => 'Rejected',
        '2'  => 'Canceled by Applicant'
    ],

    /* =========================
     | Crons
     ========================= */
    'leaveapplication.crons' => [
        'leaveapplication-notificationtohr' => 'Leave Application Notification to HR'
    ],

    /* =========================
     | Filters (Admin / Portal)
     ========================= */
    'leaveapplication.list-filters' => [
        "admin" => [
            'session_filter'      => 'Session/current_session/session-json',
            'month_filter'        => 'Month/month/month-json',
            'interval_filter'     => 'Interval/leave_days/leave_days-list',
            'leave_reason_filter' => 'Date/leave_date/leave_reason_type-list',
            'status_filter'       => 'Status/status/leaveapplication_status-json',
        ],
        "portal" => [
            'session_filter'      => 'Session/current_session/session-json',
            'month_filter'        => 'Month/month/month-json',
            'interval_filter'     => 'Interval/leave_days/leave_days-list',
            'leave_reason_filter' => 'Date/leave_date/leave_reason_type-list',
            'status_filter'       => 'Status/status/leaveapplication_status-json',
        ]
    ],

    /* =========================
     | Bulk Operations
     ========================= */
    'leaveapplication.bulk-operations' => [
        "view:detail" => "View Detail",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

    /* =========================
     | Default Columns
     ========================= */
    'leaveapplication.default-columns' => [
        'entry'  => ['leaveapplication_id','date','applicant_name','leave_all_dats','leave_type','tags','status'],
        'list'   => ['leaveapplication_id','date','applicant_name','leave_all_dats','leave_type','tags','status'],
        'detail' => ['leaveapplication_id','date','applicant_name','leave_all_dats','leave_type','tags','status'],
        'report' => ['leaveapplication_id','date','applicant_name','leave_all_dats','leave_type','tags','status'],
        'sample_export' => ['sno','applicant_name','applicant_type','leave_all_dats','leave_duration','leave_reason','status'],
        'selected_columns' => ['applicant_name','applicant_type','leave_all_dats','leave_duration','leave_reason','status']
    ],

    /* =========================
     | Communication Templates
     ========================= */
    'communicationTemplate-leaveapplication' => [
        "leaveapplication_entry_new_sms" => "New Leaveapplication Entry SMS",
        "leaveapplication_entry_new_whatsapp" => "New Leaveapplication Entry Whatsapp",
        "leaveapplication_entry_new_email" => "New Leaveapplication Entry Email",
        "leaveapplication_tohr_entry_new_sms" => "New Leaveapplication Notification to HR SMS",
        "leaveapplication_tohr_entry_new_whatsapp" => "New Leaveapplication Notification to HR Whatsapp",
        "leaveapplication_tohr_entry_new_email" => "New Leaveapplication Notification to HR Email",
        "leaveapplication_toapplicant_new_sms" => "New Leaveapplication Notification to Applicant SMS",
        "leaveapplication_toapplicant_new_whatsapp" => "New Leaveapplication Notification to Applicant Whatsapp",
        "leaveapplication_toapplicant_new_email" => "New Leaveapplication Notification to Applicant Email",
        "leaveapplication_hrresponsetoapplicant_new_sms" => "Leaveapplication Reply SMS",
        "leaveapplication_hrresponsetoapplicant_new_whatsapp" => "Leaveapplication Reply Whatsapp",
        "leaveapplication_hrresponsetoapplicant_new_email" => "Leaveapplication Reply Email"
    ],

    /* =========================
     | Helpers / Lists
     ========================= */
    'leave-day'   => ["single"=>"One Day","half-day"=>"Half Day","multiple"=>"Multiple Days"],
    'leave-shift' => ["morning"=>"Morning","afternoon"=>"Afternoon"],

    'leaveapplication_report_type-list' => [
        "singleday" => "SingleDay Report",
        "multiday"  => "Multiday Report"
    ],

    'leave-days-list' => [
        '1 day','2 days','3 days','4 days','5 days','6 days','> 7 days'
    ],

    /* =========================
     | DB Tables
     ========================= */
    'moduleTable-leaveapplication' => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_attendance",
        "cyp_leaveapplication"
    ],

];
