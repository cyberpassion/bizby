<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_customer', function (Blueprint $table) {
            // Common SaaS fields
            $table->commonSaasFields();

            // Customer-specific fields
            $table->string('business_type', 128);
            $table->string('customer_type', 128);
            $table->string('customer_name', 255)->nullable();
            $table->text('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('state', 64)->nullable();
            $table->string('gstin', 128)->nullable();
            $table->string('district', 128)->nullable();
            $table->tinyInteger('age')->nullable();
            $table->string('gender', 64)->nullable();
            $table->text('reference')->nullable();
            $table->text('remark')->nullable();
            $table->text('additional_information')->nullable();
            $table->text('additional_contacts')->nullable();
            $table->date('next_date')->nullable();
            $table->string('entry_source', 128)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_customer');
    }
};
