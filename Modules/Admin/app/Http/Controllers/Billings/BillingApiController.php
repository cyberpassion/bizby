<?php

namespace Modules\Admin\Http\Controllers\Billings;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BillingApiController extends Controller
{
    /**
     * Get current subscription
     */
    public function subscription(Request $request)
    {
        $tenant = request()->attributes->get('resolvedTenant');

        $subscription = DB::table('tenant_subscriptions')
            ->where('tenant_id', $tenant->id)
            ->orderByDesc('id')
            ->first();

        return response()->json([
            'status' => 'success',
            'data'   => $subscription
        ]);
    }

    /**
     * List available plans
     */
    public function plans()
    {
        return response()->json([
            'status' => 'success',
            'data'   => config('billing.plans'), // config/billing.php
        ]);
    }

    /**
     * Change plan
     */
    public function changePlan(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|string',
        ]);

        $tenant = request()->attributes->get('resolvedTenant');

        // TODO: proration + payment gateway

        DB::transaction(function () use ($tenant, $request) {

            DB::table('tenant_subscriptions')->insert([
                'tenant_id' => $tenant->id,
                'plan'      => $request->plan_id,
                'amount'    => config("billing.plans.{$request->plan_id}.price"),
                'starts_at' => now(),
                'ends_at'   => now()->addYear(),
                'status'    => 'active',
                'created_at'=> now(),
                'updated_at'=> now(),
            ]);

            $tenant->update([
                'plan'       => $request->plan_id,
                'valid_till' => now()->addYear(),
                'status'     => 'active',
            ]);
        });

        return response()->json([
            'status'  => 'success',
            'message' => 'Plan changed successfully'
        ]);
    }

    /**
     * Renew subscription
     */
    public function renew()
	{
    	$tenant = request()->attributes->get('resolvedTenant');

	    $planKey = $tenant->plan ?? 'yearly';
    	$plan = config("billing.plans.$planKey");

	    if (! $plan) {
    	    return response()->json([
        	    'status'  => 'error',
            	'message' => 'Invalid billing plan'
	        ], 422);
    	}

	    $baseDate = $tenant->valid_till
    	    ? \Carbon\Carbon::parse($tenant->valid_till)
        	: now();

	    // calculate new expiry
    	$newValidTill = $plan['unit'] === 'days'
        	? $baseDate->copy()->addDays($plan['duration'])
        	: $baseDate->copy()->addMonths($plan['duration']);

	    DB::transaction(function () use ($tenant, $newValidTill, $planKey) {

	        $tenant->update([
    	        'valid_till' => $newValidTill,
        	    'status'     => 'active',
	        ]);

    	    DB::table('tenant_subscriptions')->insert([
        	    'tenant_id' => $tenant->id,
            	'plan'      => $planKey,
    	        'amount'    => null, // fill after gateway
	            'starts_at' => now(),
        	    'ends_at'   => $newValidTill,
            	'status'    => 'active',
	            'created_at'=> now(),
    	        'updated_at'=> now(),
        	]);
	    });

	    return response()->json([
    	    'status'  => 'success',
        	'message' => 'Subscription renewed successfully'
	    ]);
	}

    /**
     * Cancel subscription (end of period)
     */
    public function cancel()
    {
        $tenant = request()->attributes->get('resolvedTenant');

        $tenant->update([
            'status' => 'cancelled'
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Subscription will end at period expiry'
        ]);
    }

    /**
     * List invoices
     */
    public function invoices()
    {
        return response()->json([
            'status' => 'success',
            'data'   => DB::table('invoices')
                ->where('tenant_id', tenant()->id)
                ->orderByDesc('id')
                ->get()
        ]);
    }
}
