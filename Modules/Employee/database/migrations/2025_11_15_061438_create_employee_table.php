<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_employee', function (Blueprint $table) {

            // Common SaaS Fields
            $table->commonSaasFields(); 
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

            // Employee Specific Fields
            $table->bigIncrements('employee_id');

            $table->string('employee_type', 255);
            $table->string('session', 64);
            $table->string('employee_name', 128);
            $table->string('gender', 64);
            $table->string('category', 255);

            $table->date('dob');

            $table->string('father_name', 255);
            $table->string('marital_status', 255);
            $table->string('spouse_name', 255);

            $table->text('qualifications')->nullable();

            $table->string('pan_number', 255);
            $table->string('aadhar_number', 255);
            $table->string('driving_license_number', 255);
            $table->string('voter_id_card_number', 255);
            $table->string('passport_number', 255);
            $table->string('pf_account_number', 255);

            $table->string('bank_name', 255);
            $table->string('bank_branch_name', 255);
            $table->string('bank_ifsc_code', 255);
            $table->string('bank_account_number', 255);

            $table->text('permanent_address');
            $table->string('current_address', 255);
            $table->string('phone_number', 64);
            $table->string('designation', 255);

            $table->date('date_of_joining');
            $table->date('date_of_relieving')->nullable();

            $table->string('current_salary', 8);

            $table->text('past_work_experience');
            $table->text('portal_access');

            $table->unsignedBigInteger('punch_id')->nullable();

            $table->string('email_id', 255)->nullable();

            $table->string('teaching_exam_qualified', 255)->nullable();
            $table->string('secondary_passing_year', 255)->nullable();
            $table->string('secondary_passing_roll_no', 255)->nullable();

            $table->string('qualification_level', 255)->nullable();
            $table->string('educational_qualification', 255)->nullable();
            $table->string('professional_qualification', 255)->nullable();

            $table->text('teaching_subjects')->nullable();
            $table->text('teaching_classes')->nullable();

            $table->text('announcement_permission')->nullable();
            $table->text('attendance_permission')->nullable();
            $table->text('lead_permission')->nullable();

            $table->string('is_report_permission', 255)->nullable();

            $table->text('job_location')->nullable();
            $table->text('job_responsibility')->nullable();

            $table->string('first_salary', 8000)->nullable();

            $table->text('additional_info')->nullable();
            $table->text('remark')->nullable();

            $table->string('reference', 255)->nullable();

            $table->float('consultation_fee')->nullable();
            $table->float('treatment_pervisit_fee')->nullable();

            $table->string('entry_source', 64)->nullable();
            $table->string('entry_source_type', 64)->nullable();
            $table->bigInteger('entry_source_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_employee');
    }
};


