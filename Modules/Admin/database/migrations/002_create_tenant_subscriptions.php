<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenant_subscriptions', function (Blueprint $table) {
		    $table->id();

		    $table->unsignedBigInteger('tenant_id');
		    $table->foreign('tenant_id')
        		->references('id')
		        ->on('tenant_accounts')
        		->cascadeOnDelete();

		    // Plan snapshot
		    $table->string('plan');
		    $table->decimal('amount', 10, 2)->nullable();

		    // Period
		    $table->date('starts_at');
		    $table->date('ends_at');
		    // Billing state
    		$table->string('status')->default('active');
		    // active | expired | cancelled | failed

		    // Payment
		    $table->string('payment_method')->nullable();
    		$table->string('transaction_id')->nullable();

		    // Meta
    		$table->json('meta')->nullable();

		    $table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_subscriptions');
    }
};
