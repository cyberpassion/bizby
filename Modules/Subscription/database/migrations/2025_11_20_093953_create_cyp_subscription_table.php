<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_subscription', function (Blueprint $table) {
            $table->bigIncrements('subscription_id'); // Primary Key, auto-increment
            $table->bigInteger('subscription_plan_id');
            $table->dateTime('datetime');
            $table->string('plan_type', 255);
            $table->string('plan_name', 255);
            $table->text('plan_description');
            $table->bigInteger('plan_pricing');
            $table->date('plan_start_date');
            $table->date('plan_end_date');
            $table->string('payment_recurring', 255);
            $table->tinyInteger('status');
            $table->date('date')->nullable();
            $table->string('user_type', 255)->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->date('start_date')->nullable();
            $table->bigInteger('end_date')->nullable();
            $table->string('coupon_code', 255)->nullable();
            $table->text('meta_info')->nullable();
            $table->bigInteger('client_id')->nullable();
            $table->string('subscription_user_type', 255)->nullable();
            $table->bigInteger('subscription_user_id')->nullable();
            $table->bigInteger('group_id')->nullable();
            $table->bigInteger('thread_parent')->nullable();
            $table->text('metainfo')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_subscription');
    }
};

