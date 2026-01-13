<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Import ALL Mailables at the top
|--------------------------------------------------------------------------
*/

use Modules\Shared\Mails\Billing\SubscriptionActivatedMail;
use Modules\Shared\Mails\Billing\SubscriptionExpiringMail;
use Modules\Shared\Mails\Billing\PaymentFailedMail;

use Modules\Shared\Mails\Notifications\GenericReminderMail;
use Modules\Shared\Mails\Notifications\ReminderListMail;
use Modules\Shared\Mails\Notifications\CriticalReminderMail;

use Modules\Shared\Mails\Reports\ReportSummaryMail;
use Modules\Shared\Mails\Reports\ReportTableMail;
use Modules\Shared\Mails\Reports\ReportReadyMail;
use Modules\Shared\Mails\Reports\ReportFailedMail;

/*
|--------------------------------------------------------------------------
| Email Preview Routes (LOCAL ONLY)
|--------------------------------------------------------------------------
*/

if (app()->isLocal()) {

    // BILLING
    Route::get('/_preview/email/subscription-activated', fn () =>
        new SubscriptionActivatedMail('Ravi Sharma', 'Pro Plan', 'https://bizby.app/invoices/INV-001')
    );

    Route::get('/_preview/email/subscription-expiring', fn () =>
        new SubscriptionExpiringMail('Ravi Sharma', '10 Jan 2026', 'https://bizby.app/billing')
    );

    Route::get('/_preview/email/payment-failed', fn () =>
        new PaymentFailedMail('Ravi Sharma', 'https://bizby.app/billing/payment-method')
    );

    // REMINDERS
    Route::get('/_preview/email/reminder-single', fn () =>
        new GenericReminderMail(
            'Ravi Sharma',
            'Your subscription will expire in 3 days.',
            'https://bizby.app/billing',
            'Renew Now'
        )
    );

    Route::get('/_preview/email/reminder-list', fn () =>
        new ReminderListMail(
            'Ravi Sharma',
            'You have pending tasks',
            [
                ['title' => 'Call Lead – ABC Corp', 'due' => 'Today', 'status' => 'Pending'],
                ['title' => 'Send proposal', 'due' => 'Tomorrow', 'status' => 'Pending'],
            ],
            'https://bizby.app/tasks',
            'View Tasks'
        )
    );

    Route::get('/_preview/email/reminder-critical', fn () =>
        new CriticalReminderMail(
            'Ravi Sharma',
            'Your account will be suspended due to unpaid invoice.',
            'https://bizby.app/billing',
            'Pay Now'
        )
    );

    // REPORTS
    Route::get('/_preview/email/report-summary', fn () =>
        new ReportSummaryMail(
            'Ravi Sharma',
            'Daily Cash Summary',
            [
                'Opening Balance' => '₹10,000',
                'Cash In' => '₹25,000',
                'Cash Out' => '₹8,500',
                'Closing Balance' => '₹26,500',
            ],
            'https://bizby.app/reports/cash'
        )
    );

    Route::get('/_preview/email/report-table', fn () =>
        new ReportTableMail(
            'Ravi Sharma',
            'Cash Ledger – 02 Jan 2026',
            ['Date', 'Type', 'Amount', 'Remarks'],
            [
                ['02/01', 'In', '₹12,000', 'Cash Sale'],
                ['02/01', 'Out', '₹2,500', 'Transport'],
            ],
            'https://bizby.app/reports/cash'
        )
    );

    Route::get('/_preview/email/report-ready', fn () =>
        new ReportReadyMail(
            'Ravi Sharma',
            'Monthly Cash Report Ready',
            'https://bizby.app/reports/monthly-cash'
        )
    );

    Route::get('/_preview/email/report-failed', fn () =>
        new ReportFailedMail(
            'Monthly Cash Report',
            'Database timeout while generating report'
        )
    );

}
