<?php
$pg = 'library';
$commonSettingsRoute = '/settings';

return [
	'menuItem-library' => [
    'admin' => [
        'parent' => [
            $pg => '#',
        ],
        'child' => [
            $pg => [
                [
                    'Entry' => [
                        ['Book'      => "/{$pg}/entry/book"],
                        ['Magazine'  => "/{$pg}/entry/magazine"],
                        ['Journal'   => "/{$pg}/entry/journal"],
                        ['Newspaper' => "/{$pg}/entry/newspaper"],
                    ]
                ],
                [
                    'List' => [
                        ['Book'      => "/{$pg}/list/book"],
                        ['Magazine'  => "/{$pg}/list/magazine"],
                        ['Journal'   => "/{$pg}/list/journal"],
                        ['Newspaper' => "/{$pg}/list/newspaper"],
                    ]
                ],
                [
                    'Allotment' => [
                        ['New Allotment'  => "/{$pg}/allotment/create"],
                        ['Allotment List' => "/{$pg}/allotment/list"],
                    ]
                ],
                [
                    'Report' => [
                        ['Stock Report'     => "/{$pg}/report/stock"],
                        ['Allotment Report' => "/{$pg}/report/allotment"],
                    ]
                ],
                [
                    'Settings' => [
                        ['Book Settings'       => "/{$pg}/settings/book"],
                        ['Journal Settings'    => "/{$pg}/settings/journal"],
                        ['Newspaper Settings'  => "/{$pg}/settings/newspaper"],
                        ['Magazine Settings'   => "/{$pg}/settings/magazine"],
                        ['Allotment Settings'  => "/{$pg}/settings/allotment"],
                        ['Penalty Settings'    => "/{$pg}/settings/penalty"],
                    ]
                ],
                [
                    'Plugin' => [
                        ['View Calendar' => "/{$pg}/calendar"],
                    ]
                ],
            ],
        ],
    ],
],

'sidebar-menu' => [
    [
        'title' => ucfirst($pg),
        'href'  => "/{$pg}",
        'items' => [
            [
                'title' => 'Entry',
                'items' => [
                    ['title' => 'Book',      'href' => "/module/{$pg}/entry/book"],
                    ['title' => 'Magazine',  'href' => "/module/{$pg}/entry/magazine"],
                    ['title' => 'Journal',   'href' => "/module/{$pg}/entry/journal"],
                    ['title' => 'Newspaper', 'href' => "/module/{$pg}/entry/newspaper"],
                ]
            ],
            [
                'title' => 'List',
                'items' => [
                    ['title' => 'Book',      'href' => "/module/{$pg}/list/book"],
                    ['title' => 'Magazine',  'href' => "/module/{$pg}/list/magazine"],
                    ['title' => 'Journal',   'href' => "/module/{$pg}/list/journal"],
                    ['title' => 'Newspaper', 'href' => "/module/{$pg}/list/newspaper"],
                ]
            ],
            [
                'title' => 'Allotment',
                'items' => [
                    ['title' => 'New Allotment',  'href' => "/module/{$pg}/allotment/create"],
                    ['title' => 'Allotment List', 'href' => "/module/{$pg}/allotment/list"],
                ]
            ],
            [
                'title' => 'Report',
                'items' => [
                    ['title' => 'Stock Report',     'href' => "/module/{$pg}/report/stock"],
                    ['title' => 'Allotment Report', 'href' => "/module/{$pg}/report/allotment"],
                ]
            ],
            [
                'title' => 'Settings',
                'items' => [
                    ['title' => 'Book Settings',       'href' => "/module/{$pg}/settings/book"],
                    ['title' => 'Journal Settings',    'href' => "/module/{$pg}/settings/journal"],
                    ['title' => 'Newspaper Settings',  'href' => "/module/{$pg}/settings/newspaper"],
                    ['title' => 'Magazine Settings',   'href' => "/module/{$pg}/settings/magazine"],
                    ['title' => 'Allotment Settings',  'href' => "/module/{$pg}/settings/allotment"],
                    ['title' => 'Penalty Settings',    'href' => "/module/{$pg}/settings/penalty"],
                ]
            ],
            [
                'title' => 'Plugin',
                'items' => [
                    ['title' => 'View Calendar', 'href' => "/plugin/calendar?module={$pg}"],
                ]
            ],
        ],
    ],
],
    'communicationTemplate-library' => [
                        "library_itemallotment_new_sms"		    =>	"New Library Item Allotment SMS",
                        "library_itemallotment_new_whatsapp"	=>	"New Library Entry Whatsapp",
                        "library_itemallotment_new_email"		=>	"New Library Entry Email",
                        "library_returnreminder_new_sms"		=>	"New Library Item Return Reminder SMS",
                        "library_returnreminder_new_whatsapp"	=>	"New Library Item Return Reminder Whatsapp",
                        "library_returnreminder_new_email"		=>	"New Library Item Return Reminder Email"
    ],
    'columnNameMapping-library' => [
                        'ptr'					=>	'SNo',
                        'date'					=>	'Date',
                        'item_id'				=>	'ID',
                        'item_name'				=>	'Name',
                        'recipient_name'		=>	'R/Name',
                        'publication_name'		=>	'Publication Name',
                        'total_quantity'		=>	'Quantity',
                        'available_quantity'	=>	'Available Qty',
                        'batch_group_id'		=>	'Batch',
                        'allotment_id'			=>	'ID',
                        'allotment_date'		=>	'Date',
                        'allotted_quantity'		=>	'Alloted Qty',
                        'allotment_remark'		=>	'Remark',
                        'entity_type'			=>	'Type',
                        'scheduled_return_date'	=>	'Exp Return',
                        'actual_return_date'	=>	'Return Date',
                        'items_count'			=>	'Count'
    ],
    'mandatoryOptionsBeforeUsing-library' => [
                        'missing_option'	=>	[]
    ],
    'moduleTable-library' => [
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
    'defaultColumns-library' => [
                        'entry'				=>	['item_id', 'item_name', 'entity_type', 'language', 'publication_name', 'total_quantity', 'available_quantity', 'allotted_quantity','status'],
                        'book-entry'		=>	['item_id', 'item_name', 'entity_type', 'language', 'publication_name', 'total_quantity', 'available_quantity', 'allotted_quantity','status'],
                        'newspaper-entry'	=>	['item_id', 'item_name', 'entity_type', 'language', 'publication_name', 'total_quantity', 'available_quantity', 'allotted_quantity','status'],
                        'journal-entry'		=>	['item_id', 'item_name', 'entity_type', 'language', 'publication_name', 'total_quantity', 'available_quantity', 'allotted_quantity','status'],
                        'magazine-entry'	=>	['item_id', 'item_name', 'entity_type', 'language', 'publication_name', 'total_quantity', 'available_quantity', 'allotted_quantity','status'],
                        'list'				=>	['item_id', 'item_name', 'entity_type', 'language', 'publication_name', 'total_quantity', 'available_quantity', 'allotted_quantity','status'],
                        'detail'			=>	['item_id', 'item_name', 'entity_type', 'language', 'publication_name', 'total_quantity', 'available_quantity', 'allotted_quantity','status'],
                        'report'			=>	['item_id', 'item_name', 'entity_type', 'language', 'publication_name', 'total_quantity', 'available_quantity', 'allotted_quantity','status'],
                        'allotment-list'	=>	['batch_group_id', 'allotment_id', 'allotment_date', 'recipient_name', 'scheduled_return_date', 'actual_return_date', 'delay', 'penalty','tags', 'status'],
                        'sample_export'		=>	['item_name', 'isbn', 'pages', 'language', 'accession_number', 'author_name', 'publication_name', 'publishing_year', 'subject', 'total_quantity', 'available_quantity', 'allotted_quantity'],
                        'selected_columns'	=>	['item_name', 'isbn', 'pages', 'language', 'accession_number', 'author_name', 'publication_name', 'publishing_year', 'subject', 'total_quantity', 'available_quantity', 'allotted_quantity'],
                        'stock-entry'		=>	['item_name', 'category', 'isbn', 'publication', 'available_quantity','allotted_quantity','total_quantity', 'status']
    ],
    'cronList-library' => ['library-itemreturnnotification' => 'Library Item Return Notification'],
    'mandatoryFields-library-entry-update' => ['item_name'],
    'dateFields-library-entry-update' => ['publishing_date'],
    'additionalFields-library-entry-update' => [],

    'mandatoryFields-library-item-allotment-entry-update' => ['selected-ids1', 'selected-ids2'],

    'dateFields-library-item-allotment-entry-update' => ['allotment_date', 'scheduled_return_date'],

    'additionalFields-library-item-allotment-entry-update' => [],

    'listFilters-library-book-list' => [
                        "admin"	=>	[
                            'entity_type_filter' => 'Entity Type/entity_type/library_entity_type-json',
                            'language_filter' => 'Language/language/language-json',
                            'publication_name_filter' => 'Publication/Publication/library_book_publication-json',
    
                        ],
                        "portal" => [
                            'entity_type_filter' => 'Entity Type/entity_type/library_entity_type-json',
                            'language_filter' => 'Language/language/language-json',
                            'publication_name_filter' => 'Publication/Publication/library_book_publication-json',
    
                        ]
    ],
    'listFilters-library-item' => [
                        "admin"	=>	[
                            'item_filter'	=>	"Item/item_id/library_item-json"
                        ],
                        "portal" => [
                            'item_filter'	=>	"Item/item_id/library_item-json"
                        ]
    ],
    'listFilters-library-penalty-entry-new' => [
                        "admin"	=>	[
                            'session_filter one' => 'Session/session/session-json',
                            'status_filter' => 'Status/status/status-json',
    
                        ],
                        "portal" => [
                            'session_filter one' => 'Session/session/session-json',
                            'status_filter' => 'Status/status/status-json',
    
                        ]
    ],
    'library-entity-type' => [
                        'book'		=>	'Book',
                        'magazine'	=>	'Magazine',
                        'newspaper'	=>	'Newspaper',
                        'journal'	=>	'Journal'
    ],
    'library-book-average-rating' => [1,2,3,4,5],
    
    'item-recipient-type' => ['student' => "Student", 'employee' => "Teacher/Employee"],

    'library-book-status' => ['1' => 'AVAILABLE', '2' => 'NOT-AVAILABLE'],

    'item-allotment-type' => ["item" => "Single/Multiple Item"],

    'item-allotment-status' => ["all" => "All", "pending_return" => "Pending Return", "pending_return-overdue" => "Return Overdue", "late-return" => "Late Return"],

    'sort-library-results-by-list' => [
                        "item_name"			=>	"ITEM NAME",
                        "date"				=>	"ENTRY DATE",
                        "datetime"			=>	"ENTRY DATETIME"
    ],
    'library-bulk-operation-list' => [
                        "send:email"		=>	"Send Email",
                        "send:sms"			=>	"Send SMS",
    ],
    'library-book-bulk-operation-list' => [
                        "view:details"					=>	"View Details"
    ],
    'library-penalty-amount-type' => [
                        "flat"					=>	"Flat Value",
                        "per-day"				=>	"Per Day",
    ],
    

];
