<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cashflows_old', function (Blueprint $table) {

            // SaaS standard fields
            $table->commonSaasFields();

            // Module Specific Fields
            $table->bigInteger('cash_id');
            $table->bigInteger('parent_id');

            $table->string('cash_flow', 64);
            $table->string('cash_context', 255);
            $table->unsignedBigInteger('cash_context_id');

            $table->string('pattern_name', 255);
            $table->string('cash_type', 64);
            $table->string('session', 64);

            $table->string('payee_type', 255);
            $table->string('payee_id', 64);

            $table->string('payable', 64);
            $table->string('paid', 64);
            $table->string('balance', 64);
            $table->string('concession', 64);

            $table->string('cash_code', 255);

            $table->text('cash_type_remark');
            $table->string('fee_remark', 255);

            $table->string('payment_order_id', 255);
            $table->string('payment_transaction_id', 255);
            $table->string('payment_confirmation', 255);

            $table->text('additional_info');
            $table->string('payment_mode', 255);

            $table->bigInteger('user_id')->nullable();

            $table->string('entry_by', 255)->nullable();
            $table->string('entry_by_type', 255)->nullable();
            $table->bigInteger('entry_by_id')->nullable();

            $table->tinyInteger('is_captured')->nullable();
            $table->tinyInteger('is_refunded')->nullable();

            $table->string('verified_by', 64)->nullable();

            $table->bigInteger('thread_parent')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cashflows_old');
    }
};

