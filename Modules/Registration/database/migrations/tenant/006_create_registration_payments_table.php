<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_payments', function (Blueprint $table) {
		    $table->commonSaasFields(); // includes id, tenant_id, timestamps, softDeletes
		    $table->foreignId('registration_id')->constrained()->cascadeOnDelete();

		    $table->decimal('amount', 10, 2);
		    $table->string('gateway_ref')->nullable();
			$table->string('method')->nullable(); // razorpay, stripe
			$table->timestamp('paid_at')->nullable();
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_payments');
    }
};