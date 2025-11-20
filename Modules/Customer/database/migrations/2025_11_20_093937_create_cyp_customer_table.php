<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_customer', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id');
            $table->id('customer_id');
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->string('business_type', 128);
            $table->string('customer_type', 128);
            $table->string('customer_name', 255)->nullable();
            $table->text('phone_number')->nullable();
            $table->text('email_id')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('state', 64);
            $table->string('gstin', 128);
            $table->string('district', 128);
            $table->tinyInteger('age');
            $table->string('gender', 64);
            $table->text('reference')->nullable();
            $table->text('remark')->nullable();
            $table->text('additional_information');
            $table->text('additional_contacts');
            $table->date('next_date');
            $table->string('entry_source', 128);
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_customer');
    }
};
