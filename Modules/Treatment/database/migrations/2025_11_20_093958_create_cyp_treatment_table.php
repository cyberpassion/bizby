<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_treatment', function (Blueprint $table) {
            $table->bigIncrements('treatment_id'); // Primary Key, auto-increment
            $table->bigInteger('client_id');
            $table->string('patient_type', 255);
            $table->bigInteger('patient_id');
            $table->bigInteger('treatment_sno');
            $table->date('treatment_date');
            $table->time('treatment_time');
            $table->text('observedby');
            $table->text('observation');
            $table->text('treatment_given');
            $table->text('treatment_remark');
            $table->tinyInteger('patient_status');
            $table->bigInteger('treatment_fee');
            $table->bigInteger('cash_id');
            $table->bigInteger('user_id');
            $table->string('treatment_recipient', 255)->nullable();
            $table->string('treatment_recipient_type', 64)->nullable();
            $table->bigInteger('treatment_recipient_type_id')->nullable();

            // Optional timestamps for created_at / updated_at
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_treatment');
    }
};

