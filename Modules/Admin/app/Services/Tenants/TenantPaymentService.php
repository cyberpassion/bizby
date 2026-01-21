<?php

namespace Modules\Admin\Services\Tenants;

use InvalidArgumentException;
use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Shared\Models\OnlinePayments\PaymentPayable;

use Modules\Admin\Enums\Tenants\TenantChargeType;

use Modules\Shared\Services\OnlinePayments\PreviewFormatter;

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
    ): float {
        return match ($chargeType) {
            TenantChargeType::RENEWAL->value    => $this->renewalAmount($tenant),
            TenantChargeType::ADDON->value      => $this->addonAmount($tenant),
            TenantChargeType::ONBOARDING->value => $this->onboardingAmount($tenant),
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
                TenantChargeType::RENEWAL->value    => $this->renewalSnapshot($tenant),
                TenantChargeType::ADDON->value      => $this->addonSnapshot($tenant),
                TenantChargeType::ONBOARDING->value => $this->onboardingSnapshot($tenant),
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
            TenantChargeType::RENEWAL->value    => $this->finalizeRenewal($tenant),
            TenantChargeType::ADDON->value      => $this->finalizeAddon($tenant),
            TenantChargeType::ONBOARDING->value => $this->finalizeOnboarding($tenant),
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

	    $modules = $tenant->modules()->where('is_active', true)->get();

	    $items = $modules->map(fn ($m) => [
    	    'code'       => $m->module_key,
        	'label'      => $m->module_name,
	        'quantity'   => 1,
    	    'unit_price' => $m->price,
        	'total'      => $m->price,
	        'meta'       => [],
    	])->values();

	    $subtotal = $items->sum('total');

	    return PreviewFormatter::make([
    	    'charge_type'    => $chargeType,

	        'reference_type' => 'tenant',
    	    'reference_id'   => $tenant->id,

	        'items'          => $items,

    	    'period_start'   => $start,
        	'period_end'     => $end,

	        'subtotal'       => $subtotal,
    	    'total'          => $subtotal,

	        'currency'       => 'INR',

    	    'can_pay'        => true,
        	'reason'         => null,
	    ]);
	}

}
