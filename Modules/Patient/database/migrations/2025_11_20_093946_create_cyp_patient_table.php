<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_patient', function (Blueprint $table) {
            // Common SaaS fields: id, client_id, status, timestamps, soft deletes, audit
            $table->commonSaasFields();

            // Patient-specific fields
            $table->string('patient_type', 255);
            $table->string('patient_name', 255);
            $table->string('father_name', 255)->nullable();
            $table->string('mother_name', 255)->nullable();
            $table->tinyInteger('age')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender', 255)->nullable();
            $table->string('phone_number', 255)->nullable();
            $table->string('email')->nullable();
            $table->string('aadhar_number', 64)->nullable();
            $table->string('nationality', 255)->nullable();
            $table->string('religion', 255)->nullable();
            $table->string('caste', 255)->nullable();
            $table->string('category', 255)->nullable();
            $table->string('guardian_name', 255)->nullable();
            $table->string('relation_with_guardian', 255)->nullable();
            $table->text('address')->nullable();
            $table->string('marital_status', 255)->nullable();
            $table->string('spouse_name', 255)->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->string('pulse_rate', 255)->nullable();
            $table->string('blood_pressure', 255)->nullable();
            $table->string('spo2', 255)->nullable();
            $table->text('provisional_diagnosis')->nullable();
            $table->string('health_card', 255)->nullable();
            $table->string('health_card_number', 255)->nullable();
            $table->date('admission_date')->nullable();
            $table->time('admission_time')->nullable();
            $table->string('admitted_by_type', 255)->nullable();
            $table->string('admitted_by_name', 255)->nullable();
            $table->string('admitted_by_phone_number', 255)->nullable();
            $table->text('admission_remark')->nullable();
            $table->string('is_emergency_case', 255)->nullable();
            $table->string('case_name', 255)->nullable();
            $table->string('fir_number', 255)->nullable();
            $table->string('room_number', 255)->nullable();
            $table->string('bed_number', 255)->nullable();
            $table->string('referred_by', 255)->nullable();
            $table->string('referred_to', 255)->nullable();
            $table->string('treatment_under', 255)->nullable();
            $table->text('treatment_details')->nullable();
            $table->date('discharge_date')->nullable();
            $table->time('discharge_time')->nullable();
            $table->unsignedBigInteger('discharged_by')->nullable();
            $table->text('discharge_remark')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_patient');
    }
};
