<?php
namespace Modules\Shared\Mail\Reports;

use Illuminate\Mail\Mailable;

class ReportTableMail extends Mailable
{
    public function __construct(
        public string $name,
        public string $title,
        public array $columns,
        public array $rows,
        public ?string $actionUrl = null
    ) {}

    public function build()
    {
        return $this
            ->subject($this->title)
            ->view('shared::emails.reports.table');
    }
}
