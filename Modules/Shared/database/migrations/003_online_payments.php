<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('online_payments', function (Blueprint $table) {
		    // Common SaaS fields (id, client_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();
    		$table->unsignedBigInteger('user_id')->nullable();
    		$table->morphs('payable'); // payable_type + payable_id for polymorphism
    		$table->decimal('amount', 12, 2);
    		$table->string('currency', 3)->default('INR');
    		$table->string('payment_method'); // e.g., UPI, card, netbanking
    		$table->string('transaction_id')->unique();
    		$table->text('notes')->nullable();
		    $table->index(['user_id']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('online_payments');
    }
};
