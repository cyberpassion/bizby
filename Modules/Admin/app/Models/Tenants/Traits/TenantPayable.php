<?php

namespace Modules\Admin\Models\Tenants\Traits;

use Modules\Shared\Models\OnlinePayments\PaymentPayable;
use Modules\Admin\Services\Tenants\TenantPaymentService;
use Modules\Admin\Enums\Tenants\TenantChargeType;

use Modules\Admin\Enums\Tenants\InstallationStatus;
use Modules\Admin\Enums\Tenants\OperationType;
use Modules\Admin\Enums\Tenants\TargetType;

use Modules\Admin\Models\Tenants\TenantInstallation;

/* =====================================================
 | Payable Interface Implementation
 |=====================================================*/

trait TenantPayable
{
    /**
     * Determine the amount payable for this tenant.
     */
    public function payableAmount(string $chargeType): float
    {
        return app(TenantPaymentService::class)
            ->calculateAmount($this, $chargeType);
    }

    /**
     * Provide a human-readable purpose for the payment.
     */
    public function payablePurpose(string $chargeType): string
    {
        return 'Tenant Module Subscription';
    }

    /**
     * Provide a snapshot of tenant-related data
     * at the time of checkout.
     */
    public function payableSnapshot(string $chargeType): array
    {
        return app(TenantPaymentService::class)
            ->snapshot($this, $chargeType);
    }

    /**
     * Execute business logic after successful payment.
     */
    public function markAsPaid(PaymentPayable $payment): void
    {
        //app(TenantPaymentService::class)->finalize($this, $payment);

        // Provisioning handled async
        //\Modules\Admin\Jobs\Tenants\ProvisionTenantJob::dispatch($this->id);

		$install = TenantInstallation::create([
		    'tenant_id'   => $this->id,
		    'target_type' => TargetType::TENANT,
		    'operation'   => OperationType::PROVISION,
    		'status'      => InstallationStatus::PENDING,
		]);

		\Modules\Admin\Jobs\Tenants\ProvisionTenantJob::dispatch($install->id);
    }

    /* =====================================================
     | Payment Finalize
     |=====================================================*/

    public function finalizePayment(PaymentPayable $payable): void
    {
        match ($payable->charge_type) {
            TenantChargeType::ONBOARDING->value => $this->activateTenant(),
            TenantChargeType::RENEWAL->value    => $this->renewTenant($payable),
            TenantChargeType::ADDON->value      => $this->activateAddon($payable),
            default => throw new \InvalidArgumentException('Invalid finalization type'),
        };
    }

    protected function activateTenant(): void
    {
        $this->update([
            'status' => 'active',
        ]);
    }

    protected function renewTenant(PaymentPayable $payable): void
    {
        $duration = $payable->meta['duration'] ?? '1_year';

        $extendBy = match ($duration) {
            '1_year'  => now()->addYear(),
            '6_month' => now()->addMonths(6),
            default   => now()->addYear(),
        };

        $this->update([
            'valid_till' => $this->valid_till && $this->valid_till->isFuture()
                ? $this->valid_till->add($extendBy->diff(now()))
                : $extendBy,
        ]);
    }

    protected function activateAddon(PaymentPayable $payable): void
    {
        $addonKey = $payable->meta['addon_key'] ?? null;

        if (! $addonKey) {
            throw new \InvalidArgumentException('Addon key missing');
        }

        $expiresInMonths = (int) ($payable->meta['expires_in_months'] ?? 12);

        $this->addons()->updateOrCreate(
            ['addon_key' => $addonKey],
            [
                'is_active'  => true,
                'valid_till' => now()->addMonths($expiresInMonths),
            ]
        );
    }
}
