<?php
$pg = 'visitplanner';

return [

    /* =========================
     | Status / Static Data
     ========================= */
    'visitplanner.visitactivity-generation-status' => [
        'all' => 'All',
        '1'   => 'VAR Generated',
        '2'   => 'Pending VAR',
    ],

    'visitplanner.week-name' => ['week-1','week-2','week-3','week-4','week-5'],

    'visitplanner.expectation' => [
        'high'    => 'High',
        'average' => 'Average',
        'low'     => 'Low',
    ],

    /* =========================
     | Bulk Operations
     ========================= */
    'visitplanner.bulk-operations' => [
        'view:detail' => 'View Visit Planner Details',
        'send:email'  => 'Send Email',
        'send:sms'    => 'Send SMS',
        'op:remove'   => 'Delete',
        'op:restore'  => 'Restore',
    ],

    /* =========================
     | Cron
     ========================= */
    'visitplanner.crons' => [
        'visitplanner-scheduledvisits' => 'Scheduled Visits',
    ],

    /* =========================
     | List Filters
     ========================= */
    'visitplanner.list-filters' => [
        'admin' => [
            'visitplanner_session_filter'  => 'Session/session/session-json',
            'visitplanner_employee_filter' => 'Employee/visit_by_id/employee_id-json',
            'visitplanner_month_filter'    => 'Month/month/month-json',
            'visitplanner_week_filter'     => 'Week/week/visitplanner_week-json',
            'visitplanner_status_filter'   => 'Status/status/status-json',
        ],
        'portal' => [
            'visitplanner_session_filter'  => 'Session/session/session-json',
            'visitplanner_employee_filter' => 'Employee/visit_by_id/employee_id-json',
            'visitplanner_month_filter'    => 'Month/month/month-json',
            'visitplanner_week_filter'     => 'Week/week/visitplanner_week-json',
            'visitplanner_status_filter'   => 'Status/status/status-json',
        ],
    ],

    /* =========================
     | Default Columns
     ========================= */
    'visitplanner.default-columns' => [
        'entry'   => ['ID','visitplanner_id','visit_company','visit_by_name','month','week','created_by_name','tags','status'],
        'list'    => ['ID','visitplanner_id','visit_company','visit_by_name','month','week','created_by_name','tags','status'],
        'detail'  => ['ID','visitplanner_id','visit_company','visit_by_name','month','week','created_by_name','tags','status'],
        'report'  => ['ID','visitplanner_id','visit_company','visit_by_name','month','week','created_by_name','tags','status'],
        'sample_export' => ['sno','visit_company','visit_meetingwith','visit_mobile_number','visit_email','session','month','week'],
        'selected_columns' => ['visitplanner_id','visit_company','visit_by_name','session','month','week','created_by_name'],
    ],

    /* =========================
     | Portal Permission Filters
     ========================= */
    'visitplanner.permission-allowed-filters-portal' => [
        'entry'  => [[ 'visit_by_type' => '{$login_type}', 'visit_by_id' => '{$login_id}' ]],
        'list'   => [[ 'visit_by_type' => '{$login_type}', 'visit_by_id' => '{$login_id}' ]],
        'report' => [[ 'visit_by_type' => '{$login_type}', 'visit_by_id' => '{$login_id}' ]],
    ],

    /* =========================
     | Statuses
     ========================= */
    'visitplanner.statuses' => [
        '1'  => 'Active',
        '11' => 'Postponed',
        '2'  => 'Deleted',
        '21' => 'Cancelled',
    ],

    /* =========================
     | Columns & Reports
     ========================= */
    'visitplanner.list-columns' => [
        'id','visit_date','visit_time','visit_by','visit_company','state',
    ],

    'visitplanner.report-columns' => [
        'id','session','month','week','visit_date','visit_time','visit_by',
        'visit_company','visit_company_type','state','district','visit_reason',
    ],

    /* =========================
     | Column Name Mapping
     ========================= */
    'columnNameMapping-visitplanner' => [
        'visitplanner_id'   => 'VID',
        'visit_by_name'     => 'Name',
        'visit_date'        => 'V/Date',
        'visit_time'        => 'Time',
        'visit_company'     => 'Company',
        'session'           => 'Session',
        'month'             => 'Month',
        'week'              => 'Week',
        'created_by_name'   => 'Created By',
        'visit_address'     => 'Address',
        'visit_count'       => 'V/Count',
        'visit_expectation' => 'Expectation',
        'visit_product'     => 'Products',
    ],

    /* =========================
     | Tables & Form Rules
     ========================= */
    'moduleTable-visitplanner' => [
        'cyp_term',
        'cyp_activity',
        'cyp_advancedinfo',
        'cyp_allotment',
        'cyp_cash',
        'cyp_option',
        'cyp_upload',
        'cyp_notification',
        'cyp_message',
        'cyp_visitplanner',
    ],

    'mandatoryFields-visitplanner-entry-update' => [
        'visit_company','visit_meetingwith','visit_mobile_number',
        'visit_email','session','month','week',
    ],

    'dateFields-visitplanner-entry-update' => ['date','visit_date'],

    'jsonFields-visitplanner-entry-update' => [
        'visit_team_member_json','visit_product',
    ],

    'formPrefills-visitplanner-entry-new' => [
        'columns' => [
            'product'      => 'default_product',
            'contact_mode' => 'default_contact_mode',
            'state'        => 'default_indian_state',
        ],
        'groups' => [
            'current_date' => ['contact_date'],
        ],
    ],

    /* =========================
     | Sorting
     ========================= */
    'sort-visitplanner-results-by-list' => [
        'datetime'        => 'Date & Time',
        'expectedexpense'=> 'Expected Expense',
    ],

];
