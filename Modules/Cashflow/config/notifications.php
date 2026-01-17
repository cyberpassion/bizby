<?php

return [

    /* =====================================================
       CASHFLOW (Based on cashflows table)
    ====================================================== */
    'cashflow' => [

        /* =====================================================
           CASHFLOW ENTRY CREATED (IN / OUT)
        ====================================================== */
        'entry_created' => [

            /* PREVIEW DATA (maps to cashflows table) */
            'preview' => [
                'direction'         => 'in', // in | out
                'amount'            => '2500.00',
                'transaction_date'  => '2026-01-18',
                'category'          => 'fee',
                'sub_category'      => 'tuition_fee',
                'payment_mode'      => 'upi',
                'reference_no'      => 'UPI-889912',
                'party_type'        => 'Student',
                'party_name'        => 'Ravi Sharma',
                'description'       => 'January tuition fee received',
            ],

            'email' => [
                'subject' => 'Cashflow Entry Added ({{direction}})',
                'view'    => 'shared::emails.cashflow.entry-created',
            ],
        ],

        /* =====================================================
           CASHFLOW PAYMENT RECEIVED (direction = in)
        ====================================================== */
        'payment_received' => [

            'preview' => [
                'amount'           => '1200.00',
                'transaction_date' => '2026-01-18',
                'category'         => 'fee',
                'payment_mode'     => 'upi',
                'reference_no'     => 'PAY-5581',
                'party_type'       => 'Student',
                'party_name'       => 'Ravi Sharma',
            ],

            'email' => [
                'subject' => 'Payment Received Successfully',
                'view'    => 'shared::emails.cashflow.payment-received',
            ],
        ],

        /* =====================================================
           CASHFLOW EXPENSE RECORDED (direction = out)
        ====================================================== */
        'expense_recorded' => [

            'preview' => [
                'amount'           => '8000.00',
                'transaction_date' => '2026-01-20',
                'category'         => 'salary',
                'sub_category'     => 'developer_salary',
                'payment_mode'     => 'bank',
                'reference_no'     => 'NEFT-99112',
                'party_type'       => 'Employee',
                'party_name'       => 'Akanksha Sharma',
                'description'      => 'January salary',
            ],

            'email' => [
                'subject' => 'Expense Recorded',
                'view'    => 'shared::emails.cashflow.expense-recorded',
            ],
        ],

        /* =====================================================
           CASHFLOW UPDATED
        ====================================================== */
        'entry_updated' => [

            'preview' => [
                'direction'         => 'in',
                'amount'            => '3000.00',
                'transaction_date'  => '2026-01-18',
                'category'          => 'fee',
                'sub_category'      => 'tuition_fee',
                'payment_mode'      => 'cash',
                'reference_no'      => null,
                'party_type'        => 'Student',
                'party_name'        => 'Ravi Sharma',
            ],

            'email' => [
                'subject' => 'Cashflow Entry Updated',
                'view'    => 'shared::emails.cashflow.entry-updated',
            ],
        ],

        /* =====================================================
           DAILY CASH SUMMARY (by transaction_date)
        ====================================================== */
        'daily_summary' => [

            'preview' => [
                'transaction_date' => '2026-01-18',
                'total_in'          => '15500.00',
                'total_out'         => '8200.00',
                'net_balance'       => '7300.00',
            ],

            'email' => [
                'subject' => 'Daily Cashflow Summary – {{transaction_date}}',
                'view'    => 'shared::emails.cashflow.daily-summary',
            ],
        ],
    ],
];
