<?php

namespace Modules\Admin\Jobs\Tenants;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use Modules\Admin\Models\Tenants\TenantAccount;
use Modules\Admin\Mail\TenantUpcomingRenewalMail;

class SendTenantUpcomingRenewals implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * How many days before renewal to notify
     */
    protected int $daysBefore = 7;

    public function handle(): void
    {
        $targetDate = Carbon::now()->addDays($this->daysBefore)->startOfDay();

        $subscriptions = TenantAccount::query()
            ->whereDate('renewal_date', $targetDate)
            ->where('status', 'active')
            ->get();

        if ($subscriptions->isEmpty()) {
            return;
        }

        foreach ($subscriptions as $subscription) {
            $this->notifyTenant($subscription);
        }
    }

    protected function notifyTenant(TenantAccount $subscription): void
    {
        try {
            Mail::to($subscription->tenant_email)
                ->send(new \Modules\Shared\Mail\Admin\AdminAlertMail($subscription));

        } catch (\Throwable $e) {
            Log::error('Failed to send tenant renewal reminder', [
                'tenant_id'       => $subscription->tenant_id,
                'subscription_id' => $subscription->id,
                'error'           => $e->getMessage(),
            ]);
        }
    }
}
