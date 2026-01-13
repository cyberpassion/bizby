<?php
namespace Modules\Shared\Mails\Reports;

use Illuminate\Mail\Mailable;

class ReportAttachmentMail extends Mailable
{
    public function __construct(
        public string $name,
        public string $title,
        public string $filePath
    ) {}

    public function build()
    {
        return $this
            ->subject($this->title)
            ->view('shared::emails.reports.attachment')
            ->attach($this->filePath);
    }
}
