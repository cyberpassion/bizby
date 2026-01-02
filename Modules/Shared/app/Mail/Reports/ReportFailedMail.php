<?php
namespace Modules\Shared\Mail\Reports;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportFailedMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $title,
        public string $error
    ) {}

    public function build()
    {
        return $this->subject('Report generation failed')
            ->view('shared::emails.reports.failed');
    }
}
