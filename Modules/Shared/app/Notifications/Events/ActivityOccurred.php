<?php

namespace Modules\Shared\Notifications\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActivityOccurred
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public string $activityKey,
        public int $tenantId,
        public string $toEmail,
        public ?string $toMobile = null,
        public array $data = []
    ) {}
}
