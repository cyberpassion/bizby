<?php
namespace Modules\Shared\Mails\DTOs;

class ActivityMailData
{
    public function __construct(
        public string $subject,
        public string $view,
        public array $variables
    ) {}
}
