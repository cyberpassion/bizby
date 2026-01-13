<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Import ALL Mailables at the top
|--------------------------------------------------------------------------
*/

use Modules\Admin\Mails\Admin\AdminAlertMail;
use Modules\Admin\Mails\Auth\LoginOtpMail;
use Modules\Admin\Mails\Auth\ForgotPasswordMail;
use Modules\Admin\Mails\Auth\RegistrationConfirmationMail;
use Modules\Admin\Mails\Auth\RegistrationPendingReminderMail;
use Modules\Admin\Mails\Auth\EmailVerificationMail;
use Modules\Admin\Mails\Auth\LoginAlertMail;
use Modules\Admin\Mails\Auth\AccountLockedMail;

use Modules\Admin\Mails\Engagement\InactivityNudgeMail;

/*
|--------------------------------------------------------------------------
| Email Preview Routes (LOCAL ONLY)
|--------------------------------------------------------------------------
*/

if (app()->isLocal()) {

	// ADMIN
    Route::get('/_preview/email/admin-alert', fn () =>
        new AdminAlertMail('New tenant created: ABC School (ID: 1023)')
    );

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

	// Test sending of real emails
	Route::get('/_test/email/send-login-otp', function () {
	    Mail::to('ravi@cyberpassion.com')
    	    ->send(new LoginOtpMail(
        	    'Ravi Sharma',
            	'482913'
	        ));

	    return '✅ Login OTP test email sent';
	});

	// ENGAGEMENT
    Route::get('/_preview/email/inactivity', fn () =>
        new InactivityNudgeMail('Ravi Sharma', 'https://bizby.app/login')
    );

}
