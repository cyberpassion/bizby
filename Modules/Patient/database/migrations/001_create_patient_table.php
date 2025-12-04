<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {

            //  Common SaaS fields (adds: id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps)
            $table->commonSaasFields();

			// Patient/person info using macro
            $table->commonPersonFields();

            // Patient Basic Details
            $table->string('patient_type')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();

            $table->string('guardian_name')->nullable();
            $table->string('relation_with_guardian')->nullable();

            // Vitals
            $table->float('height')->nullable();
            $table->float('weight')->nullable();

            $table->string('pulse_rate', 50)->nullable();
            $table->string('blood_pressure', 50)->nullable();
            $table->string('spo2', 50)->nullable();

            // Diagnosis
            $table->text('provisional_diagnosis')->nullable();

            // Health Card
            $table->string('health_card')->nullable();
            $table->string('health_card_number', 64)->nullable();

            // Admission
            $table->date('admission_date')->nullable();
            $table->time('admission_time')->nullable();

            $table->string('admitted_by_type')->nullable();
            $table->string('admitted_by_name')->nullable();
            $table->string('admitted_by_phone_number')->nullable();

            $table->text('admission_remark')->nullable();

            // Emergency Case
            $table->string('is_emergency_case', 10)->nullable();
            $table->string('case_name')->nullable();
            $table->string('fir_number')->nullable();

            // Room / Bed
            $table->string('room_number', 50)->nullable();
            $table->string('bed_number', 50)->nullable();

            // Referrals
            $table->string('referred_by')->nullable();
            $table->string('referred_to')->nullable();

            // Treatment Info
            $table->string('treatment_under')->nullable();
            $table->text('treatment_details')->nullable();

            // Discharge
            $table->date('discharge_date')->nullable();
            $table->time('discharge_time')->nullable();
            $table->unsignedBigInteger('discharged_by')->nullable();
            $table->text('discharge_remark')->nullable();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};