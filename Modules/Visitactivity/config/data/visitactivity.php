<?php
$pg = 'visitactivity';

return [

    /* =========================
     | List Filters
     ========================= */
    'visitactivity.list-filters' => [
        'admin' => [
            'visitactivity_visitby_filter' => "Visit By/visit_by_id/employee_id-json",
            'visitactivity_date_filter'    => "Date/visit_date/visitactivity_date-json",
            'visitactivity_status_filter'  => "Status/status/visitactivity_status-json",
        ],
        'portal' => [
            'visitactivity_visitby_filter' => "Visit By/visit_by_id/employee_id-json",
            'visitactivity_date_filter'    => "Date/visit_date/visitactivity_date-json",
            'visitactivity_status_filter'  => "Status/status/visitactivity_status-json",
        ],
    ],

    /* =========================
     | Bulk Operations
     ========================= */
    'visitactivity.bulk-operations' => [
        'view:detail' => 'View Visit Activity Details',
        'send:email'  => 'Send Notification Email',
        'op:remove'   => 'Delete',
        'op:restore'  => 'Restore',
    ],

    /* =========================
     | Default Columns
     ========================= */
    'visitactivity.default-columns' => [
        'entry'   => ['visitactivity_id','visit_date','visit_by_name','visit_team_member_json','company_name','company_official_mobile_number','detailed_report','next_action_plan','visit_status','tags','status'],
        'list'    => ['visitactivity_id','visit_date','visit_by_name','visit_team_member_json','company_name','company_official_mobile_number','detailed_report','next_action_plan','visit_status','tags','status'],
        'detail'  => ['visitactivity_id','visit_date','visit_by_name','visit_team_member_json','company_name','company_official_mobile_number','detailed_report','next_action_plan','visit_status','tags','status'],
        'report'  => ['visitactivity_id','visit_date','visit_by_name','visit_team_member_json','company_name','company_official_mobile_number','detailed_report','next_action_plan','visit_status','tags','status'],
        'sample_export' => ['sno','visit_date','visit_by_name','visit_team_member_json','company_name','company_official_mobile_number','detailed_report','next_action_plan','visit_status'],
        'selected_columns' => ['visit_date','visit_by_name','company_name','visit_status'],
    ],

    /* =========================
     | Statuses
     ========================= */
    'visitactivity.statuses' => [
        1  => 'Submitted',
        11 => 'Autosaved',
        2  => 'Deleted',
    ],

    'visitactivity.visit-statuses' => [
        '0'  => 'Select',
        '1'  => 'Visit Done',
        '2'  => 'Cancelled',
        '11' => 'Postponed by Client',
        '12' => 'Postponed by Office',
    ],

    'visitactivity.customer-statuses' => [
        'new-customer'          => 'New Customer',
        'old-customer'          => 'Old Customer',
        'dissatisfied-customer' => 'Dissatisfied Customer',
        'biased-customer'       => 'Biased Customer',
    ],

    /* =========================
     | Reports
     ========================= */
    'visitactivity.list-columns' => [
        'visit_date',
        'visit_by',
        'company_name',
        'visit_status',
        'total_expense_amount',
    ],

    'visitactivity.report-columns' => [
        'visit_date',
        'visit_by',
        'company_name',
        'company_official_name',
        'company_official_email',
        'company_official_mobile_number',
        'visit_status',
        'reason_for_dissatisfaction',
        'products_discussed',
        'detailed_report',
        'next_action_plan',
        'total_expense_amount',
    ],

    /* =========================
     | DB & Form Settings
     ========================= */
    'moduleTable-visitactivity' => [
        'cyp_term',
        'cyp_activity',
        'cyp_advancedinfo',
        'cyp_allotment',
        'cyp_cash',
        'cyp_option',
        'cyp_upload',
        'cyp_notification',
        'cyp_message',
        'cyp_visitactivity',
    ],

    'mandatoryFields-visitactivity-entry-update' => [
        'movement_from',
        'company_official_mobile_number',
        'company_address',
    ],

    'dateFields-visitactivity-entry-update' => [
        'visit_date',
        'next_visit_date',
    ],

    'jsonFields-visitactivity-entry-update' => [
        'visit_team_member_json',
        'detailed_report',
        'next_action_plan',
        'visit_product',
        'products_discussed',
        'email_to',
        'competitors',
    ],

];
