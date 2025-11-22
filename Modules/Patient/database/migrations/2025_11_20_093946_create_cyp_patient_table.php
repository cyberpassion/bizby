<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_patient', function (Blueprint $table) {
			$table->id();
            $table->bigInteger('client_id');
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->string('patient_type', 255);
            $table->string('patient_name', 255);
            $table->string('father_name', 255);
            $table->string('mother_name', 255);
            $table->tinyInteger('age');
            $table->date('dob');
            $table->string('gender', 255);
            $table->string('phone_number', 255);
            $table->string('email');
            $table->string('aadhar_number', 64)->nullable();
            $table->string('nationality', 255);
            $table->string('religion', 255);
            $table->string('caste', 255);
            $table->string('category', 255);
            $table->string('guardian_name', 255);
            $table->string('relation_with_guardian', 255);
            $table->text('address');
            $table->string('marital_status', 255);
            $table->string('spouse_name', 255);
            $table->float('height');
            $table->float('weight');
            $table->string('pulse_rate', 255);
            $table->string('blood_pressure', 255);
            $table->string('spo2', 255);
            $table->text('provisional_diagnosis');
            $table->string('health_card', 255);
            $table->string('health_card_number', 255);
            $table->date('admission_date');
            $table->time('admission_time');
            $table->string('admitted_by_type', 255);
            $table->string('admitted_by_name', 255);
            $table->string('admitted_by_phone_number', 255);
            $table->text('admission_remark');
            $table->string('is_emergency_case', 255);
            $table->string('case_name', 255);
            $table->string('fir_number', 255);
            $table->string('room_number', 255);
            $table->string('bed_number', 255);
            $table->string('referred_by', 255);
            $table->string('referred_to', 255);
            $table->string('treatment_under', 255);
            $table->text('treatment_details');
            $table->date('discharge_date');
            $table->time('discharge_time');
            $table->bigInteger('discharged_by');
            $table->text('discharge_remark');
            $table->tinyInteger('status')->nullable();

            // Optional: timestamps if you want created_at/updated_at fields
            // $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_patient');
    }
};

