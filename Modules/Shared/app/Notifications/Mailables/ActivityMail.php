<?php

namespace Modules\Shared\Notifications\Mailables;

use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class ActivityMail extends Mailable implements ShouldQueue
{
    use SerializesModels;

    public function __construct(
        public string $subjectLine,
        public string $templateView,
        public array $variables
    ) {}

    public function build()
    {
        return $this
            ->subject($this->subjectLine)
            ->view($this->templateView)
            ->with($this->variables);
    }
}
