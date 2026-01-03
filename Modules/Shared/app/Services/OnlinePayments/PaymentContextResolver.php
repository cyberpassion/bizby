<?php

namespace Modules\Shared\Services\OnlinePayments;

use Illuminate\Support\Str;
use InvalidArgumentException;

class PayableContextResolver
{
    public function __construct(
        protected PayableResolver $payableResolver
    ) {}

    public function resolve(
        string $payableType,
        int $payableId,
        string $purpose
    ): array {
        // 1️⃣ Resolve payable model safely
        $payable = $this->payableResolver->resolve($payableType, $payableId);

        // 2️⃣ Route based on model + purpose
        return match (true) {
            $payable instanceof \Modules\Admin\Models\Tenant
                => $this->resolveTenant($payable, $purpose),

            $payable instanceof \Modules\Registration\Models\Registration
                => $this->resolveRegistration($payable, $purpose),

            default
                => throw new InvalidArgumentException('Unsupported payable model'),
        };
    }

    /* ---------------- TENANT ---------------- */

    protected function resolveTenant($tenant, string $purpose): array
    {
        return match ($purpose) {
            'choose-module'
                => app(TenantModulePayable::class)->handle($tenant),

            default
                => throw new InvalidArgumentException('Invalid tenant payment purpose'),
        };
    }

    /* ---------------- REGISTRATION ---------------- */

    protected function resolveRegistration($registration, string $purpose): array
    {
        return match ($purpose) {
            'registration-fee'
                => app(RegistrationFeePayable::class)->handle($registration),

            default
                => throw new InvalidArgumentException('Invalid registration payment purpose'),
        };
    }
}
