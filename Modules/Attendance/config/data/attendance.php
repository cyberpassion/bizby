<?php

use Modules\Attendance\Support\Actions;
use Modules\Attendance\Support\Res;
use Modules\Shared\Support\KeyName;

$pg = 'attendance';

return [
    'weekdays' => [
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
        7 => 'Sunday',
    ],

    'day-types' => [
        'working' => 'Working Day',
        'holiday' => 'Holiday',
        'weekend' => 'Weekend',
        'blackout' => 'Blackout',
        'special_working' => 'Special Working Day',
    ],

    /*
    |----------------------------------------------------------------------
    | List (used by backend queries)
    |----------------------------------------------------------------------
    */
    'list' => [
        'filters' => [
            'session',
            'month',
            'absent_date',
            'absentee_type',
            'absent_code',
            'is_paid',
            'status',
        ],
        'columns' => [
            'absent_date',
            'absentee_id',
            'absentee_type',
            'absent_date_part',
            'absent_duration',
            'is_paid',
        ],
    ],

    // Default Columns
    'columns' => [
        KeyName::make(Res::WEEKLY_OFFS) => [
            Actions::LIST => [
                'id' => 'ID',
                'weekday_label' => 'Weekday',
                'context' => 'Context',
                'status_label' => 'Status',
            ],
        ],

        KeyName::make(Res::HOLIDAYS) => [
            Actions::LIST => [
                'id' => 'ID',
                'date' => 'Date',
                'name' => 'Name',
                'context' => 'Context',
                'status_label' => 'Status',
            ],
        ],

        KeyName::make(Res::CALENDAR_DAYS) => [
            Actions::LIST => [
                'id' => 'ID',
                'date' => 'Date',
                'day_type' => 'Type',
                'reason' => 'Reason',
                'context' => 'Context',
                'status_label' => 'Status',
            ],
        ],

        KeyName::make(Res::SCHEDULES) => [
            Actions::LIST => [
                'id' => 'ID',
                'name' => 'Name',
                'session' => 'Session',
                'start_time' => 'Start Time',
                'end_time' => 'End Time',
                'context' => 'Context',
                'attendance_mode' => 'Attendance Mode',
            ],
        ],

        KeyName::make(Res::BATCHES) => [
            Actions::LIST => [
                'id' => 'ID',
                'name' => 'Name',
                'start_date' => 'Start Date',
                'end_date' => 'End Date',
                'participant_count' => 'Participant Count',
            ],
        ],

        KeyName::make(Res::SESSIONS) => [
            Actions::LIST => [
                'id' => 'ID',
                'session_date' => 'Session Date',
                'type' => 'Type',
                'start_time' => 'Start Time',
                'participants' => 'Participants',
                'end_time' => 'End Time',
                'mode' => 'Mode',
                'taken_by' => 'Taken By',
            ],
        ],

        KeyName::make(Res::ATTENDANCES) => [

            // Generic Report
            'report' => [
                'id' => 'ID',
                'session_date' => 'Date',
                'session_type' => 'Session Type',
                'participant_name' => 'Name',
                'entity_type' => 'Entity Type',
                'attendance_status' => 'Status',
                'code' => 'Code',
                'in_time' => 'In Time',
                'out_time' => 'Out Time',
                'source' => 'Source',
            ],

            // Daily Report
            'daily-report' => [
                'id' => 'ID',
                'participant_name' => 'Name',
                'attendance_status' => 'Status',
                'in_time' => 'In Time',
                'out_time' => 'Out Time',
                'duration' => 'Duration',
                'remarks' => 'Remarks',
            ],

            // Today Report

            'today-report' => [
                'id' => 'ID',
                'participant_name' => 'Name',
                'entity_type' => 'Entity Type',
                'session' => 'Session',
                'attendance_status' => 'Status',
                'code' => 'Code',
            ],

            // Monthly Report
            'monthly-report' => [
                'id' => 'ID',
                'participant_name' => 'Name',
                'entity_type' => 'Entity Type',
                'working_days' => 'Working Days',
                'present_days' => 'Present',
                'absent_days' => 'Absent',
                'late_days' => 'Late',
                'leave_days' => 'Leave',
                'attendance_percentage' => 'Attendance %',
            ],

            // Entity Report
            'entity-report' => [
                'id' => 'ID',
                'session_date' => 'Date',
                'session' => 'Session',
                'attendance_status' => 'Status',
                'in_time' => 'In Time',
                'out_time' => 'Out Time',
                'duration' => 'Duration',
                'late' => 'Late',
                'source' => 'Source',
                'code' => 'Code',
                'remark' => 'Remark',
            ],

            // Batch Report
            'batch-report' => [
                'id' => 'ID',
                'participant_name' => 'Participant',
                'present_days' => 'Present',
                'absent_days' => 'Absent',
                'late_days' => 'Late',
                'leave_days' => 'Leave',
                'attendance_percentage' => 'Attendance %',
            ],

            // Session Report
            'session-report' => [
                'id' => 'ID',
                'participant_name' => 'Participant',
                'attendance_status' => 'Status',
                'in_time' => 'In Time',
                'out_time' => 'Out Time',
                'duration' => 'Duration',
                'reason' => 'Reason',
            ],

            // Absent Report
            'absent-report' => [
                'id' => 'ID',
                'session_date' => 'Date',
                'participant_name' => 'Name',
                'entity_type' => 'Entity Type',
                'attendance_status' => 'Status',
                'session' => 'Session',
                'source' => 'Source',
                'code' => 'Absent Code',
                'reason' => 'Reason',
            ],

            // Present Report
            'present-report' => [
                'id' => 'ID',
                'session_date' => 'Date',
                'participant_name' => 'Name',
                'entity_type' => 'Entity Type',
                'attendance_status' => 'Status',
                'in_time' => 'In Time',
                'out_time' => 'Out Time',
                'duration' => 'Duration',
                'source' => 'Source',
            ],

            // Late Report
            'late-report' => [
                'id' => 'ID',
                'session_date' => 'Date',
                'participant_name' => 'Name',
                'entity_type' => 'Entity Type',
                'session' => 'Session',
                'in_time' => 'In Time',
                'late_by' => 'Late By',
                'source' => 'Source',
                'code' => 'Late Code',
                'reason' => 'Reason',
            ],

            // Percentage Report
            'percentage-report' => [
                'entity_type' => 'Entity Type',
                'participant_name' => 'Name',
                'total_sessions' => 'Total Sessions',
                'present_count' => 'Present',
                'absent_count' => 'Absent',
                'attendance_percentage' => 'Attendance %',
            ],

            // Analysis Report
            'analysis-report' => [
                'attendance_status' => 'Attendance Status',
                'total' => 'Total',
                'percentage' => 'Percentage',
            ],
        ],

    ],

    /*
    |----------------------------------------------------------------------
    | Report Columns
    |----------------------------------------------------------------------
    */
    'report_columns' => [
        'id',
        'absent_date',
        'session',
        'month',
        'absentee_type',
        'absentee_id',
        'absent_date_part',
        'absent_duration',
        'absent_code',
        'absent_reason',
        'is_paid',
        'created_at',
    ],

    /*
    |----------------------------------------------------------------------
    | Lookups / Enums
    |----------------------------------------------------------------------
    */
    'paid_unpaid' => [
        'false' => 'Unpaid',
        'true' => 'Paid',
    ],

    'report_types' => [
        'attendance-register-count-only' => 'Day Attendance (Percentage & Count)',
        'attendance-register' => 'Day Attendance (Absentee Names Highlighted)',
        'singleday-absentee' => 'Day Absentees Only',
        'multidays-absentees-with-count' => 'Multidays Attendance Report',
        'attendance-sheet' => 'Attendance Sheet',
        'portal-access-report' => 'Portal & App Access Report',
    ],

    /*
    |----------------------------------------------------------------------
    | Validation Rules
    |----------------------------------------------------------------------
    */
    'mandatory_fields' => ['selected-ids'],
    'date_fields' => ['date'],

    /*
    |----------------------------------------------------------------------
    | Communication Templates
    |----------------------------------------------------------------------
    */
    'communication_templates' => [
        'attendance_entry_new_sms' => 'New Attendance Entry SMS',
        'attendance_entry_new_whatsapp' => 'New Attendance Entry Whatsapp',
        'attendance_entry_new_email' => 'New Attendance Entry Email',
    ],

    /*
    |----------------------------------------------------------------------
    | DB Tables
    |----------------------------------------------------------------------
    */
    'tables' => [
        'terms',
        'cyp_activity',
        'cyp_advancedinfo',
        'cyp_allotment',
        'cyp_cash',
        'cyp_option',
        'uploads',
        'cyp_notification',
        'cyp_message',
        'cyp_announcement',
    ],

    // Session Types
    'session-types' => [
        'day' => 'Day (School)',
        'lecture' => 'Lecture (College / Coaching)',
        'shift' => 'Shift (Office / Factory)',
        'event' => 'Event / Seminar',
    ],

    // Attendance Modes
    'modes' => [
        'manual' => 'Manual',
        'qr' => 'QR Code',
        'biometric' => 'Biometric',
        'rfid' => 'RFID',
        'geofence' => 'Geo-fence',
        'self' => 'Self Punch',
        'system' => 'System',
    ],

    'attendance-statuses' => [
        'present' => 'Present',
        'absent' => 'Absent',
    ],

    'absence-codes' => [
        'sick_leave' => 'Sick Leave',
        'casual_leave' => 'Casual Leave',
        'paid_leave' => 'Paid Leave',
        'unpaid_leave' => 'Unpaid Leave',
        'medical_emergency' => 'Medical Emergency',
        'family_emergency' => 'Family Emergency',
        'late_approved' => 'Late Approved',
        'on_duty' => 'On Duty',
        'holiday' => 'Holiday',
        'unknown' => 'Unknown',
    ],

    'monthly-report-types' => [
        'overview' => 'Overview',
        'attendance_summary' => 'Attendance Summary',
        'absence_summary' => 'Absence Summary',
        'late_summary' => 'Late Summary',
        'leave_summary' => 'Leave Summary',
        'percentage_summary' => 'Percentage Summary',
        'daily_matrix' => 'Daily Matrix',
    ],

    'analysis-types' => [
        'attendance_trend' => 'Attendance Trend',
        'absence_trend' => 'Absence Trend',
        'late_trend' => 'Late Trend',
        'leave_analysis' => 'Leave Analysis',
        'entity_comparison' => 'Entity Comparison',
        'batch_comparison' => 'Batch Comparison',
        'department_comparison' => 'Department Comparison',
        'performance_analysis' => 'Performance Analysis',
        'working_day_analysis' => 'Working Day Analysis',
        'monthly_distribution' => 'Monthly Distribution',
    ],

    'analysis-groupings' => [
        'day' => 'Day',
        'week' => 'Week',
        'month' => 'Month',
        'entity' => 'Entity',
        'batch' => 'Batch',
        'session_type' => 'Session Type',
        'status' => 'Attendance Status',
    ],

];
