<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_subscription', function (Blueprint $table) {
            // Common SaaS fields: id, client_id, status, timestamps, soft deletes, audit
            $table->commonSaasFields();

            // Subscription-specific fields
            $table->unsignedBigInteger('subscription_plan_id');
            $table->string('plan_type', 255)->nullable();
            $table->string('plan_name', 255)->nullable();
            $table->text('plan_description')->nullable();
            $table->bigInteger('plan_pricing')->nullable();
            $table->date('plan_start_date')->nullable();
            $table->date('plan_end_date')->nullable();
            $table->string('payment_recurring', 255)->nullable();
            $table->string('user_type', 255)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('coupon_code', 255)->nullable();
            $table->text('meta_info')->nullable();
            $table->string('subscription_user_type', 255)->nullable();
            $table->unsignedBigInteger('subscription_user_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('thread_parent')->nullable();
            $table->text('metainfo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_subscription');
    }
};


