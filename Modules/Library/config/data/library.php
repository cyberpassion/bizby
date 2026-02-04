<?php
$pg = 'library';

return [

    'library.crons' => [
        'library-itemreturnnotification' => 'Library Item Return Notification'
    ],

    'library.bulk-operations' => [
        "send:email" => "Send Email",
        "send:sms"   => "Send SMS",
    ],

    'library.default-columns' => [
        'entry' => ['item_id','item_name','entity_type','language','publication_name','total_quantity','available_quantity','allotted_quantity','status'],
        'list'  => ['item_id','item_name','entity_type','language','publication_name','total_quantity','available_quantity','allotted_quantity','status'],
        'detail'=> ['item_id','item_name','entity_type','language','publication_name','total_quantity','available_quantity','allotted_quantity','status'],
        'report'=> ['item_id','item_name','entity_type','language','publication_name','total_quantity','available_quantity','allotted_quantity','status'],
    ],

    'communicationTemplate-library' => [
        "library_itemallotment_new_sms"        => "New Library Item Allotment SMS",
        "library_itemallotment_new_whatsapp"   => "New Library Entry Whatsapp",
        "library_itemallotment_new_email"      => "New Library Entry Email",
        "library_returnreminder_new_sms"       => "Library Item Return Reminder SMS",
        "library_returnreminder_new_whatsapp"  => "Library Item Return Reminder Whatsapp",
        "library_returnreminder_new_email"     => "Library Item Return Reminder Email",
    ],

    'columnNameMapping-library' => [
        'item_id'            => 'ID',
        'item_name'          => 'Name',
        'publication_name'   => 'Publication',
        'total_quantity'     => 'Quantity',
        'available_quantity' => 'Available',
        'allotted_quantity'  => 'Allotted',
        'entity_type'        => 'Type',
    ],

    'moduleTable-library' => [
        "cyp_library_item",
        "cyp_library_item_allotment",
        "cyp_notification",
        "cyp_message",
        "cyp_upload",
    ],

    'library-entity-type' => [
        'book'      => 'Book',
        'magazine'  => 'Magazine',
        'newspaper' => 'Newspaper',
        'journal'   => 'Journal',
    ],

    'library-book-status' => [
        '1' => 'AVAILABLE',
        '2' => 'NOT AVAILABLE',
    ],

    'item-recipient-type' => [
        'student'  => "Student",
        'employee' => "Teacher/Employee",
    ],

    'library-penalty-amount-type' => [
        'flat'    => 'Flat Value',
        'per-day' => 'Per Day',
    ],

];
