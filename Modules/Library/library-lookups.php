<?php
$pg = 'library';

return [

    // -------------------------------
    // Communication Templates
    // -------------------------------
    "communicationTemplate-library" => [
        "library_itemallotment_new_sms"       => "New Library Item Allotment SMS",
        "library_itemallotment_new_whatsapp"  => "New Library Entry Whatsapp",
        "library_itemallotment_new_email"     => "New Library Entry Email",
        "library_returnreminder_new_sms"      => "New Library Item Return Reminder SMS",
        "library_returnreminder_new_whatsapp" => "New Library Item Return Reminder Whatsapp",
        "library_returnreminder_new_email"    => "New Library Item Return Reminder Email"
    ],

    // -------------------------------
    // Column Name Mapping
    // -------------------------------
    "columnNameMapping-library" => [
        'ptr'                   => 'SNo',
        'date'                  => 'Date',
        'item_id'               => 'ID',
        'item_name'             => 'Name',
        'recipient_name'        => 'R/Name',
        'publication_name'      => 'Publication Name',
        'total_quantity'        => 'Quantity',
        'available_quantity'    => 'Available Qty',
        'batch_group_id'        => 'Batch',
        'allotment_id'          => 'ID',
        'allotment_date'        => 'Date',
        'allotted_quantity'     => 'Alloted Qty',
        'allotment_remark'      => 'Remark',
        'entity_type'           => 'Type',
        'scheduled_return_date' => 'Exp Return',
        'actual_return_date'    => 'Return Date',
        'items_count'           => 'Count'
    ],

    // -------------------------------
    // Menu
    // -------------------------------
    "menuItem-library" => [
        "admin" => [
            'parent' => [
                ucfirst($pg) => [$pg . '/home', $pg . '/list']
            ],
            'child' => [
                $pg => [
                    'Entry'      => $pg . '/entry/new',
                    'List'       => $pg . '/entry/new',
                    'Allotment'  => $pg . '/allotment-entry/new',
                    'Report'     => $pg . '/stock-report',
                    'Settings'   => $pg . '/settings'
                ]
            ],
            'child-2' => [
                "{$pg}-entry" => [
                    'Book'      => $pg . '/book-entry/new',
                    'Magazine'  => $pg . '/magazine-entry/new',
                    'Journal'   => $pg . '/journal-entry/new',
                    'Newspaper' => $pg . '/newspaper-entry/new'
                ],
                "{$pg}-list" => [
                    'Book'      => $pg . '/book-list/new',
                    'Magazine'  => $pg . '/magazine-list/new',
                    'Journal'   => $pg . '/journal-list/new',
                    'Newspaper' => $pg . '/newspaper-list/new'
                ],
                "{$pg}-allotment" => [
                    'New Allotment' => $pg . '/allotment-entry/new',
                    'Allotment List'=> $pg . '/allotment-list'
                ],
                "{$pg}-report" => [
                    'Stock Report'    => $pg . '/stock-report',
                    'Allotment Report'=> $pg . '/report'
                ],
                "{$pg}-settings" => [
                    'Book Settings'      => $pg . '/book-settings',
                    'Journal Settings'   => $pg . '/journal-settings',
                    'Newspaper Settings' => $pg . '/newspaper-settings',
                    'Magazine Settings'  => $pg . '/magazine-settings',
                    'Allotment Settings' => $pg . '/allotment-settings',
                    'Penalty Settings'   => $pg . '/penalty-settings'
                ]
            ]
        ],
        "portal" => [
            'parent' => [
                ucfirst($pg) => [$pg . '/home', $pg . '/list']
            ],
            'child' => [
                $pg => [
                    'My Books'        => $pg . '/allotment-list',
                    'Allotment Report'=> $pg . '/report'
                ]
            ]
        ]
    ],

    // -------------------------------
    // Page Structure
    // -------------------------------
    "pgStructure-library" => [
        $pg => [
            'forms/form'  => ['entry','book-entry','magazine-entry','newspaper-entry','journal-entry','itemset-entry','allotment-entry','book-settings','magazine-settings','journal-settings','newspaper-settings','settings','penalty-settings','stock-report','report'],
            'lists/list'  => ['list','book-list','magazine-list','newspaper-list','journal-list','allotment-list'],
            'views/view'  => ['home','document','profile','detail','history','allotment-slip']
        ]
    ],

    // -------------------------------
    // Mandatory Options before using module
    // -------------------------------
    "mandatoryOptionsBeforeUsing-library" => [
        'missing_option' => []
    ],

    // -------------------------------
    // Module Tables
    // -------------------------------
    "moduleTable-library" => [
        "cyp_term",
        "cyp_activity",
        "cyp_advancedinfo",
        "cyp_allotment",
        "cyp_cash",
        "cyp_option",
        "cyp_upload",
        "cyp_notification",
        "cyp_message",
        "cyp_library_item",
        "cyp_library_item_allotment"
    ],

    // -------------------------------
    // Default Columns
    // -------------------------------
    "defaultColumns-library" => [
        'entry'           => ['item_id','item_name','entity_type','language','publication_name','total_quantity','available_quantity','allotted_quantity','status'],
        'book-entry'      => ['item_id','item_name','entity_type','language','publication_name','total_quantity','available_quantity','allotted_quantity','status'],
        'journal-entry'   => ['item_id','item_name','entity_type','language','publication_name','total_quantity','available_quantity','allotted_quantity','status'],
        'newspaper-entry' => ['item_id','item_name','entity_type','language','publication_name','total_quantity','available_quantity','allotted_quantity','status'],
        'magazine-entry'  => ['item_id','item_name','entity_type','language','publication_name','total_quantity','available_quantity','allotted_quantity','status'],
        'list'            => ['item_id','item_name','entity_type','language','publication_name','total_quantity','available_quantity','allotted_quantity','status'],
        'detail'          => ['item_id','item_name','entity_type','language','publication_name','total_quantity','available_quantity','allotted_quantity','status'],
        'report'          => ['item_id','item_name','entity_type','language','publication_name','total_quantity','available_quantity','allotted_quantity','status'],
        'allotment-list'  => ['batch_group_id','allotment_id','allotment_date','recipient_name','scheduled_return_date','actual_return_date','delay','penalty','tags','status'],
        'sample_export'   => ['item_name','isbn','pages','language','accession_number','author_name','publication_name','publishing_year','subject','total_quantity','available_quantity','allotted_quantity'],
        'selected_columns'=> ['item_name','isbn','pages','language','accession_number','author_name','publication_name','publishing_year','subject','total_quantity','available_quantity','allotted_quantity'],
        'stock-entry'     => ['item_name','category','isbn','publication','available_quantity','allotted_quantity','total_quantity','status']
    ],

    // -------------------------------
    // Cron List
    // -------------------------------
    "cronList-library" => [
        'library-itemreturnnotification' => 'Library Item Return Notification'
    ],

    // -------------------------------
    // Mandatory Fields
    // -------------------------------
    "mandatoryFields-library_entry" => ['item_name'],
    "mandatoryFields-library_item-allotment-entry" => ['selected-ids1','selected-ids2'],

    // -------------------------------
    // Date Fields
    // -------------------------------
    "dateFields-library_entry" => ['publishing_date'],
    "dateFields-library_item-allotment-entry" => ['allotment_date','scheduled_return_date'],

    // -------------------------------
    // Additional Fields
    // -------------------------------
    "additionalFields-library_entry" => [],
    "additionalFields-library_item-allotment-entry" => [],

    // -------------------------------
    // List Filters
    // -------------------------------
    "listFilters-library_entry" => [
        "admin" => [
            'entity_type_filter'       => 'Entity Type/entity_type/library_entity_type-json',
            'language_filter'          => 'Language/language/language-json',
            'publication_name_filter'  => 'Publication/Publication/library_book_publication-json'
        ],
        "portal" => [
            'entity_type_filter'       => 'Entity Type/entity_type/library_entity_type-json',
            'language_filter'          => 'Language/language/language-json',
            'publication_name_filter'  => 'Publication/Publication/library_book_publication-json'
        ]
    ],
    "listFilters-library_allotment-entry" => [
        "admin" => ['item_filter' => 'Item/item_id/library_item-json'],
        "portal"=> ['item_filter' => 'Item/item_id/library_item-json']
    ],

    // -------------------------------
    // Library Entity Types
    // -------------------------------
    "library_entity_type-json" => [
        'book'      => 'Book',
        'magazine'  => 'Magazine',
        'newspaper' => 'Newspaper',
        'journal'   => 'Journal'
    ],

    // -------------------------------
    // Item Status
    // -------------------------------
    "library_book_status-json" => [
        '1' => 'AVAILABLE',
        '2' => 'NOT-AVAILABLE'
    ],

    // -------------------------------
    // Item Allotment Status
    // -------------------------------
    "item_allotment_status-json" => [
        "all" => "All",
        "pending_return" => "Pending Return",
        "pending_return-overdue" => "Return Overdue",
        "late-return" => "Late Return"
    ],

    // -------------------------------
    // Sort Options
    // -------------------------------
    "sort_library_results_by-list" => [
        "item_name" => "ITEM NAME",
        "date"      => "ENTRY DATE",
        "datetime"  => "ENTRY DATETIME"
    ],

    // -------------------------------
    // Bulk Operations
    // -------------------------------
    "library_bulk_operation-list" => [
        "send:email" => "Send Email",
        "send:sms"   => "Send SMS"
    ],

    "library_book_bulk_operation-list" => [
        "view:details" => "View Details"
    ],

    // -------------------------------
    // Penalty Type
    // -------------------------------
    "library_penalty_amount_type-json" => [
        "flat"    => "Flat Value",
        "per-day" => "Per Day"
    ]

];
