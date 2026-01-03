<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Import ALL Mailables at the top
|--------------------------------------------------------------------------
*/

use Modules\Shared\Mail\Auth\LoginOtpMail;
use Modules\Shared\Mail\Auth\ForgotPasswordMail;
use Modules\Shared\Mail\Auth\RegistrationConfirmationMail;
use Modules\Shared\Mail\Auth\RegistrationPendingReminderMail;
use Modules\Shared\Mail\Auth\EmailVerificationMail;
use Modules\Shared\Mail\Auth\LoginAlertMail;
use Modules\Shared\Mail\Auth\AccountLockedMail;

use Modules\Shared\Mail\Billing\SubscriptionActivatedMail;
use Modules\Shared\Mail\Billing\SubscriptionExpiringMail;
use Modules\Shared\Mail\Billing\PaymentFailedMail;

use Modules\Shared\Mail\Notifications\GenericReminderMail;
use Modules\Shared\Mail\Notifications\ReminderListMail;
use Modules\Shared\Mail\Notifications\CriticalReminderMail;

use Modules\Shared\Mail\Reports\ReportSummaryMail;
use Modules\Shared\Mail\Reports\ReportTableMail;
use Modules\Shared\Mail\Reports\ReportReadyMail;
use Modules\Shared\Mail\Reports\ReportFailedMail;

use Modules\Shared\Mail\Admin\AdminAlertMail;
use Modules\Shared\Mail\Engagement\InactivityNudgeMail;

/*
|--------------------------------------------------------------------------
| Email Preview Routes (LOCAL ONLY)
|--------------------------------------------------------------------------
*/

if (app()->isLocal()) {

    // AUTH
    Route::get('/_preview/email/login-otp', fn () =>
        new LoginOtpMail('Ravi Sharma', '482913')
    );

    Route::get('/_preview/email/forgot-password', fn () =>
        new ForgotPasswordMail('Ravi Sharma', 'https://bizby.app/reset/abc123')
    );

    Route::get('/_preview/email/registration-confirmation', fn () =>
        new RegistrationConfirmationMail('Ravi Sharma', 'https://bizby.app/login')
    );

    Route::get('/_preview/email/registration-pending', fn () =>
        new RegistrationPendingReminderMail('Ravi Sharma', 'https://bizby.app/register/resume')
    );

    Route::get('/_preview/email/email-verification', fn () =>
        new EmailVerificationMail('Ravi Sharma', 'https://bizby.app/verify/email/xyz')
    );

    Route::get('/_preview/email/login-alert', fn () =>
        new LoginAlertMail('Ravi Sharma', '103.21.45.67', 'Chrome on macOS')
    );

    Route::get('/_preview/email/account-locked', fn () =>
        new AccountLockedMail('Ravi Sharma')
    );

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

    // ADMIN
    Route::get('/_preview/email/admin-alert', fn () =>
        new AdminAlertMail('New tenant created: ABC School (ID: 1023)')
    );

    // ENGAGEMENT
    Route::get('/_preview/email/inactivity', fn () =>
        new InactivityNudgeMail('Ravi Sharma', 'https://bizby.app/login')
    );

	// Test sending of real emails
	Route::get('/_test/email/send-login-otp', function () {
	    Mail::to('ravi@cyberpassion.com')
    	    ->send(new LoginOtpMail(
        	    'Ravi Sharma',
            	'482913'
	        ));

	    return '✅ Login OTP test email sent';
	});

}
