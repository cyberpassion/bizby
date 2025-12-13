<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('online_payments', function (Blueprint $table) {
		    $table->id();
		    $table->unsignedBigInteger('tenant_id');
    		$table->unsignedBigInteger('user_id')->nullable();
    		$table->morphs('payable'); // payable_type + payable_id for polymorphism
    		$table->decimal('amount', 12, 2);
    		$table->string('currency', 3)->default('USD');
    		$table->string('payment_method'); // e.g., UPI, card, netbanking
    		$table->string('transaction_id')->unique();
    		$table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
    		$table->text('notes')->nullable();
    		$table->timestamps();

		    $table->index(['user_id', 'tenant_id', 'status']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('online_payments');
    }
};
