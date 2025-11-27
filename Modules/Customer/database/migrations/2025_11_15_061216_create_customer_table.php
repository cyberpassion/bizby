<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_customer', function (Blueprint $table) {

            // Common SaaS Fields
            $table->commonSaasFields();
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

            // Module Specific Fields
            $table->bigIncrements('customer_id'); // Primary Key, UNSIGNED


            $table->string('business_type', 255);
            $table->string('customer_type', 255);

            $table->string('customer_name', 255)->nullable();

            $table->text('phone_number')->nullable();
            $table->text('email')->nullable();
            $table->text('permanent_address')->nullable();

            $table->tinyInteger('age');
            $table->string('gender', 64);

            $table->text('reference')->nullable();

            $table->date('next_date');

            $table->text('remark')->nullable();
            $table->text('additional_contacts');

            $table->string('state', 64)->nullable();
            $table->string('gstin', 255)->nullable();
            $table->string('district', 255)->nullable();

            $table->text('additional_information')->nullable();
            $table->text('email_id')->nullable();

            $table->string('entry_source', 128)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_customer');
    }
};


