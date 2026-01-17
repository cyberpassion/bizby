<?php

return [

    'library' => [

        /* =================================================
           NEW BOOK ADDED / UPDATED
           → libraries table
        ================================================= */
        'book_added_or_updated' => [

            'source_table' => 'libraries',

            'preview' => [
                'library_id'        => 101,
                'isbn'              => '978-81-12345-678-9',
                'item_name'         => 'Introduction to Physics',
                'description'       => 'Basic concepts of Physics for beginners.',
                'page_count'        => 350,
                'price'             => '450.00',
                'language'          => 'English',
                'author_name'       => 'Dr. Ramesh Sharma',
                'publication_name'  => 'ABC Publications',
                'publishing_year'   => '2025',
                'publishing_date'   => '2025-06-15',
                'average_rating'    => 4.5,
                'category'          => 'Science',
                'total_quantity'    => 20,
                'is_currently_in_use'=> 'Yes',
                'entity_type'       => 'Library',
                'accession_number'  => 'LIB-2025-001',
            ],

            'email' => [
                'subject' => '{{ item_name }} has been {{ is_currently_in_use == "Yes" ? "added" : "updated" }} to the library',
                'view'    => 'shared::emails.library.book-stock-update',
            ],
        ],

        /* =================================================
           BOOK OVERDUE REMINDER (library transaction join)
           → can join libraries table with transactions
        ================================================= */
        'book_overdue_reminder' => [

            'source_table' => 'library_transactions',

            'preview' => [
                'library_id'        => 101,
                'item_name'         => 'Introduction to Physics',
                'recipient_name'    => 'Aman Verma',
                'due_date'          => '2026-01-25',
                'days_overdue'      => 10,
            ],

            'email' => [
                'subject' => 'Overdue Book Reminder: {{ item_name }}',
                'view'    => 'shared::emails.library.book-overdue-reminder',
            ],
        ],

        /* =================================================
           BOOK TRANSACTION (ISSUED / RETURNED)
           → library transaction
        ================================================= */
        'book_transaction' => [

            'source_table' => 'library_transactions',

            'preview' => [
                'library_id'        => 101,
                'item_name'         => 'Introduction to Physics',
                'recipient_name'    => 'Aman Verma',
                'transaction_type'  => 'issued', // issued | returned
                'transaction_date'  => '2026-02-05',
                'due_date'          => '2026-02-15', // only if issued
            ],

            'email' => [
                'subject' => '{{ transaction_type == "issued" ? "Book Issued" : "Book Returned" }}: {{ item_name }}',
                'view'    => 'shared::emails.library.book-transaction',
            ],
        ],

    ],

];
