<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_payables', function (Blueprint $table) {
            $table->id();

            /* ---------------------------------
             | Polymorphic Payable Target
             |----------------------------------*/
            $table->string('payable_type');   // tenant_account | student_fee | registration | etc
            $table->unsignedBigInteger('payable_id');

			$table->unsignedBigInteger('online_payment_id')->nullable();

			/*$table->foreign('online_payment_id')
			    ->references('id')
			    ->on('online_payments')
			    ->nullOnDelete();*/

			$table->unique('online_payment_id');

            /* ---------------------------------
             | Optional Tenant Context
             |----------------------------------*/
            $table->uuid('tenant_id')->nullable()->index();
            // null for central payments (tenant onboarding)
            // filled for tenant-level payments

            /* ---------------------------------
             | Amount & Currency
             |----------------------------------*/
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('INR');

            /* ---------------------------------
             | Status & Purpose
             |----------------------------------*/
            $table->string('status')->default('pending');
            // pending | paid | failed | cancelled | expired

            $table->string('charge_type')->nullable();
			// Machine readable: "tenant_subscription_activate"

			$table->string('purpose')->nullable();
            // Human readable: "Tenant subscription activation"

            /* ---------------------------------
             | Metadata
             |----------------------------------*/
            $table->json('meta')->nullable();
            // plan, modules, duration, semester, breakdown, etc

            /* ---------------------------------
             | Resolution Tracking
             |----------------------------------*/
            $table->timestamp('resolved_at')->nullable();
            // when business logic was executed

            $table->timestamp('expires_at')->nullable();
            // optional: auto-expire unpaid payables

            $table->timestamps();

            /* ---------------------------------
             | Indexes
             |----------------------------------*/
            $table->index(['payable_type', 'payable_id']);

			$table->unique(
		    	['payable_type', 'payable_id', 'status'],
			    'uniq_active_payable'
			);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_payables');
    }
};
