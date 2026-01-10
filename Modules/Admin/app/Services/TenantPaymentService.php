<?php

namespace Modules\Admin\Services;

use InvalidArgumentException;
use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Shared\Models\OnlinePayments\PaymentPayable;

use Modules\Admin\Enums\ChargeType;

/**
 * Class TenantPaymentService
 *
 * Handles tenant-specific payment calculations,
 * snapshots, and post-payment finalization.
 *
 * This service contains ALL billing logic related
 * to tenants and their modules.
 */
class TenantPaymentService
{
    /**
     * Calculate payable amount for a tenant
     * based on the given charge type.
     *
     * @param TenantAccount $tenant
     * @param string|null $chargeType
     * @return float
     */
    public function calculateAmount(
        TenantAccount $tenant,
        string $chargeType
    ): float {echo ChargeType::ONBOARDING;die();
        return match ($chargeType) {
            ChargeType::RENEWAL    => $this->renewalAmount($tenant),
            ChargeType::ADDON      => $this->addonAmount($tenant),
            ChargeType::ONBOARDING => $this->onboardingAmount($tenant),
            default      => throw new InvalidArgumentException('Invalid charge type'),
        };
    }

    /**
     * Create a snapshot of what is being paid.
     *
     * Stored permanently with PaymentPayable
     * to preserve historical accuracy.
     *
     * @param TenantAccount $tenant
     * @param string|null $chargeType
     * @return array<string, mixed>
     */
    public function snapshot(
        TenantAccount $tenant,
        string $chargeType
    ): array {
        return [
            'tenant_id'   => $tenant->id,
            'charge_type' => $chargeType,
            'breakdown'   => match ($chargeType) {
                ChargeType::RENEWAL    => $this->renewalSnapshot($tenant),
                ChargeType::ADDON      => $this->addonSnapshot($tenant),
                ChargeType::ONBOARDING => $this->onboardingSnapshot($tenant),
            },
            'total'       => $this->calculateAmount($tenant, $chargeType),
        ];
    }

    /**
     * Execute business logic after successful payment.
     *
     * Called ONLY after payment confirmation.
     *
     * @param TenantAccount $tenant
     * @param PaymentPayable $payment
     * @return void
     */
    public function finalize(
        TenantAccount $tenant,
        PaymentPayable $payment
    ): void {
        $tenant->update([
            'payment_status' => 'paid',
            'paid_at'        => now(),
        ]);

        // Apply effects based on charge type
        match ($payment->charge_type) {
            ChargeType::RENEWAL    => $this->finalizeRenewal($tenant),
            ChargeType::ADDON      => $this->finalizeAddon($tenant),
            ChargeType::ONBOARDING => $this->finalizeOnboarding($tenant),
        };
    }

    /* =====================================================
     | Charge Type Implementations
     |=====================================================*/

    protected function onboardingAmount(TenantAccount $tenant): float
    {
        return $tenant->modules()
            ->where('is_active', true)
            ->sum('price');
    }

    protected function renewalAmount(TenantAccount $tenant): float
    {
        return $tenant->modules()
            ->where('is_active', true)
            ->sum('renewal_price');
    }

    protected function addonAmount(TenantAccount $tenant): float
    {
        return $tenant->modules()
            ->where('is_active', true)
            ->where('is_paid', false)
            ->sum('price');
    }

    protected function onboardingSnapshot(TenantAccount $tenant): array
    {
        return $this->moduleSnapshot(
            $tenant->modules()->where('is_active', true)->get()
        );
    }

    protected function renewalSnapshot(TenantAccount $tenant): array
    {
        return $this->moduleSnapshot(
            $tenant->modules()->where('is_active', true)->get(),
            priceColumn: 'renewal_price'
        );
    }

    protected function addonSnapshot(TenantAccount $tenant): array
    {
        return $this->moduleSnapshot(
            $tenant->modules()
                ->where('is_active', true)
                ->where('is_paid', false)
                ->get()
        );
    }

    protected function moduleSnapshot($modules, string $priceColumn = 'price'): array
    {
        return $modules->map(fn ($m) => [
            'name'  => $m->module_name,
            'price' => $m->{$priceColumn},
        ])->toArray();
    }

    protected function finalizeOnboarding(TenantAccount $tenant): void
    {
        $tenant->modules()
            ->where('is_active', true)
            ->update(['is_paid' => true]);
    }

    protected function finalizeRenewal(TenantAccount $tenant): void
    {
        $tenant->update([
            'renewed_at' => now(),
        ]);
    }

    protected function finalizeAddon(TenantAccount $tenant): void
    {
        $tenant->modules()
            ->where('is_active', true)
            ->where('is_paid', false)
            ->update(['is_paid' => true]);
    }

	public function preview(TenantAccount $tenant, string $chargeType): array
	{
    	$now = now();

	    $currentValidTill = $tenant->valid_till;

	    $start = $currentValidTill && $currentValidTill->isFuture()
    	    ? $currentValidTill
        	: $now;

	    $end = $start->copy()->addYear();

	    $modules = $tenant->modules()
    	    ->where('is_active', true)
        	->get();

	    $amount = $modules->sum('price');

	    return [
    	    'charge_type'        => $chargeType,
        	'current_valid_till' => $currentValidTill,
	        'renewal_start'      => $start,
    	    'renewal_end'        => $end,
        	'amount'             => $amount,
	        'currency'           => 'INR',
    	    'modules'            => $modules->map(fn ($m) => [
        	    'module_key' => $m->module_key,
            	'name'       => $m->module_name,
            	'price'      => $m->price,
	        ]),
    	    'can_renew' => true,
        	'reason'    => null,
    	];
	}

}
