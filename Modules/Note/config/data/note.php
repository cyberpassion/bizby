<?php
$pg = 'note';

return [

    /* =========================
     | Status & Crons
     ========================= */
    "note.statuses" => [
        "1"  => "All",
        "11" => "Pending Only",
        "12" => "Resolved Only",
        "2"  => "Deleted"
    ],

    "note.crons" => [
        'note-timeboundnotification' => 'Note Reminders'
    ],

    /* =========================
     | Filters
     ========================= */
    "note.list-filters" => [
        "admin" => [
            'date_filter'      => "date/date/note_date-json",
            'session_filter'   => "Session/session/session-json",
            'added_by_filter'  => "added by/added_by_type/added_by_type-list",
            'note_type'        => "note type/note_type/student_note_type-json",
            'status'           => "status/status/status-json"
        ],
        "portal" => [
            'date_filter'      => "date/date/note_date-json",
            'session_filter'   => "Session/session/session-json",
            'added_by_filter'  => "added by/added_by_type/added_by_type-list",
            'note_type'        => "note type/note_type/student_note_type-json",
            'status'           => "status/status/status-json"
        ]
    ],

    /* =========================
     | Bulk Operations
     ========================= */
    "note.bulk-operations" => [
        "view:detail" => "View Detail",
        "op:remove"   => "Delete",
        "op:restore"  => "Restore"
    ],

    /* =========================
     | Columns
     ========================= */
    "note.default-columns" => [
        'entry'   => ['note_id','added_by','subject','note_type','added_for','response_status','tags','status'],
        'list'    => ['note_id','added_by','subject','note_type','added_for','response_status','tags','status'],
        'detail'  => ['note_id','added_by','subject','note_type','added_for','response_status','tags','status'],
        'report'  => ['note_id','added_by','subject','note_type','added_for','response_status','tags','status'],
    ],

    "note.report-columns" => [
        'id','subject','note_type','context','added_for','added_by',
        'note_end_date','note_end_time','created_at'
    ],

    /* =========================
     | Communication Templates
     ========================= */
    "communicationTemplate-note" => [
        "note_entry_new_sms"   => "New Note Entry SMS",
        "note_entry_new_email" => "New Note Entry Email",
        "note_comment_new_sms"=> "New Note Comment SMS",
    ],

    /* =========================
     | Column Mapping
     ========================= */
    "columnNameMapping-note" => [
        'note_id'         => 'ID',
        'added_by'        => 'Name',
        'note_type'       => 'Type',
        'added_for'       => 'For',
        'response_status' => 'R/Status'
    ],

    /* =========================
     | DB Tables
     ========================= */
    "moduleTable-note" => [
        "terms",
        "cyp_activity",
        "cyp_notification",
        "cyp_message",
        "cyp_note"
    ],

    /* =========================
     | Validation
     ========================= */
    "mandatoryFields-note-entry-update" => ['information'],
    "dateFields-note-entry-update"      => ['date','note_end_date'],

];
