<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_treatment', function (Blueprint $table) {

            // Primary Key
            $table->id('treatment_id');

            // Common SaaS fields: client_id, status, audit, softDeletes, timestamps
            $table->commonSaasFields();

            // Patient & Treatment Details
            $table->string('patient_type', 255);
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('treatment_sno');
            $table->date('treatment_date');
            $table->time('treatment_time');
            $table->text('observedby')->nullable();
            $table->text('observation')->nullable();
            $table->text('treatment_given')->nullable();
            $table->text('treatment_remark')->nullable();
            $table->tinyInteger('patient_status')->nullable();
            $table->bigInteger('treatment_fee')->nullable();
            $table->bigInteger('cash_id')->nullable();
            $table->bigInteger('user_id')->nullable();

            // Optional: Recipient tracking
            $table->string('treatment_recipient', 255)->nullable();
            $table->string('treatment_recipient_type', 64)->nullable();
            $table->unsignedBigInteger('treatment_recipient_type_id')->nullable();

            // Optional: thread / hierarchy
            $table->unsignedBigInteger('thread_parent')->nullable();
            $table->longText('additional_info')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_treatment');
    }
};
