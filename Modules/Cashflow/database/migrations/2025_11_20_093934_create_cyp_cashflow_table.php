<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_cashflow', function (Blueprint $table) {
            // Common SaaS fields
            $table->commonSaasFields();

            // Cashflow-specific fields
            $table->bigInteger('cash_id');
            $table->bigInteger('parent_id')->nullable();
            $table->string('cash_flow', 64);
            $table->string('cash_context', 255);
            $table->unsignedBigInteger('cash_context_id');
            $table->string('pattern_name', 255);
            $table->string('cash_type', 64);
            $table->string('session', 64);

            // Polymorphic for payee
            $table->string('payee_type', 255)->nullable();
            $table->unsignedBigInteger('payee_id')->nullable();

            $table->string('payable', 64);
            $table->string('paid', 64);
            $table->string('balance', 64);
            $table->string('concession', 64);
            $table->string('cash_code', 255);
            $table->string('remark', 255)->nullable();
            $table->text('cash_type_remark')->nullable();
            $table->string('fee_remark', 255)->nullable();
            $table->string('payment_order_id', 255)->nullable();
            $table->string('payment_transaction_id', 255)->nullable();
            $table->string('payment_confirmation', 255)->nullable();
            $table->text('additional_info')->nullable();
            $table->string('payment_mode', 255)->nullable();

            // Polymorphic for entry_by
            $table->string('entry_by_type', 255)->nullable();
            $table->unsignedBigInteger('entry_by_id')->nullable();

            $table->tinyInteger('is_captured')->nullable();
            $table->tinyInteger('is_refunded')->nullable();

            // Polymorphic for verified_by
            $table->string('verified_by_type', 64)->nullable();
            $table->unsignedBigInteger('verified_by_id')->nullable();

            $table->bigInteger('thread_parent')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_cashflow');
    }
};


