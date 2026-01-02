<?php
namespace Modules\Shared\Mail\Reports;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportReadyMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $title,
        public string $reportUrl
    ) {}

    public function build()
    {
        return $this->subject($this->title)
            ->view('shared::emails.reports.ready');
    }
}
