<?php

namespace Modules\Admin\Models\Tenants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Schema;

// Online Payments Specific
use Modules\Shared\Contracts\OnlinePayments\Payable;
use Modules\Shared\Models\OnlinePayments\PaymentPayable;

use Modules\Admin\Services\TenantPaymentService;

class TenantAccount extends Model implements Payable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    /**
     * Default attribute values
     */
    protected $attributes = [];

	protected function dynamicFillable()
    {
        // Example dynamic load from DB table
        return Schema::getColumnListing($this->getTable());
    }

    public function getFillable()
    {
        return $this->dynamicFillable();
    }

	public function tenantusers()
	{
    	return $this->hasMany(TenantUser::class);
	}

	public function modules()
	{
    	return $this->hasMany(TenantModule::class, 'tenant_id');
	}

	/* =====================================================
     | Payable Interface Implementation
     |=====================================================*/

    /**
     * Determine the amount payable for this tenant.
     *
     * Called during checkout to calculate the final
     * amount to be charged.
     *
     * NOTE:
     * This can later be replaced with plan-based pricing,
     * module-based billing, or usage-based billing.
     *
     * @return float
     */
    public function payableAmount( string $chargeType ): float
    {
        return app(TenantPaymentService::class)->calculateAmount($this,$chargeType);
    }

    /**
     * Provide a human-readable purpose for the payment.
     *
     * Used in:
     * - Payment records
     * - Razorpay order notes
     * - Invoices and receipts
     * - Admin dashboards
     *
     * @return string
     */
    public function payablePurpose( string $chargeType ): string
    {
        return 'Tenant Module Subscription';
    }

    /**
     * Provide a snapshot of tenant-related data
     * at the time of checkout.
     *
     * This data is stored with the payment record
     * to preserve historical accuracy even if
     * tenant data changes later.
     *
     * @return array<string, mixed>
     */
    public function payableSnapshot( string $chargeType ): array
    {
        return app(TenantPaymentService::class)->snapshot($this,$chargeType);
    }

    /**
     * Execute business logic after successful payment.
     *
     * This method is called ONLY after the payment
     * is confirmed via gateway/webhook.
     *
     * Typical responsibilities:
     * - Mark tenant as paid
     * - Activate tenant
     * - Enable subscribed modules
     *
     * IMPORTANT:
     * This method must be idempotent (safe to call once).
     *
     * @param PaymentPayable $payment
     * @return void
     */
    public function markAsPaid(PaymentPayable $payment): void
    {
        app(TenantPaymentService::class)->finalize($this, $payment);

        // Optional: trigger tenant activation
        // $this->activate();
    }
}