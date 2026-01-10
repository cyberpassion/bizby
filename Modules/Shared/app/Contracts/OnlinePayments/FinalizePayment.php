<?php
namespace Modules\Shared\Contracts\OnlinePayments;

use Modules\Shared\Models\OnlinePayments\PaymentPayable;

interface FinalizePayment
{
    public function finalizePayment(
        PaymentPayable $payable
    ): void;
}
