<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('online_payments', function (Blueprint $table) {
		    $table->commonSaasFields();

		    $table->unsignedBigInteger('user_id')->nullable();
		    $table->morphs('payable');

		    $table->decimal('amount', 12, 2);
		    $table->decimal('refunded_amount', 12, 2)->default(0);

		    $table->string('currency', 3)->default('INR');

		    $table->string('payment_gateway'); // razorpay, stripe
		    $table->string('payment_method');  // upi, card

		    $table->string('payment_status')->default('initiated');

		    $table->string('transaction_id')->nullable();
		    $table->string('gateway_order_id')->nullable()->index();
		    $table->string('gateway_payment_id')->nullable()->index();

		    $table->timestamp('paid_at')->nullable();

		    $table->text('notes')->nullable();

		    $table->index(['user_id']);
    		$table->index(['payment_status']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('online_payments');
    }
};
