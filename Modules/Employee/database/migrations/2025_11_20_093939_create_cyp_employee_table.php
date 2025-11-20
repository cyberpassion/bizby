<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_employee', function (Blueprint $table) {
            $table->bigInteger('client_id');
            $table->bigIncrements('employee_id');
            $table->date('date')->nullable();
            $table->dateTime('datetime');
            $table->string('employee_type', 255);
            $table->string('session', 64);
            $table->string('employee_name', 128);
            $table->string('gender', 64);
            $table->string('category', 255);
            $table->date('dob');
            $table->string('father_name', 255);
            $table->string('marital_status', 255);
            $table->string('spouse_name', 255);
            $table->string('teaching_exam_qualified', 255);
            $table->string('secondary_passing_year', 255);
            $table->string('secondary_passing_roll_no', 255);
            $table->string('qualification_level', 255);
            $table->text('qualifications')->nullable();
            $table->string('pan_number', 255);
            $table->string('aadhar_number', 255);
            $table->string('driving_license_number', 255);
            $table->string('voter_id_card_number', 255);
            $table->string('passport_number', 255);
            $table->unsignedBigInteger('punch_id')->nullable();
            $table->string('pf_account_number', 255);
            $table->string('bank_name', 255);
            $table->string('bank_branch_name', 255);
            $table->string('bank_ifsc_code', 255);
            $table->string('bank_account_number', 255);
            $table->string('educational_qualification', 255);
            $table->string('professional_qualification', 255);
            $table->text('teaching_subjects');
            $table->text('teaching_classes')->nullable();
            $table->text('permanent_address');
            $table->string('current_address', 255);
            $table->string('phone_number', 64);
            $table->string('email_id', 255);
            $table->text('announcement_permission');
            $table->text('attendance_permission');
            $table->text('lead_permission');
            $table->string('is_report_permission', 255);
            $table->text('job_location');
            $table->string('designation', 255);
            $table->text('job_responsibility');
            $table->date('date_of_joining');
            $table->date('date_of_relieving')->nullable();
            $table->string('first_salary', 8000);
            $table->string('current_salary', 8);
            $table->text('past_work_experience');
            $table->text('additional_info');
            $table->text('remark');
            $table->string('reference', 255);
            $table->text('portal_access');
            $table->float('consultation_fee');
            $table->float('treatment_pervisit_fee');
            $table->string('entry_source', 64);
            $table->string('entry_source_type', 64);
            $table->bigInteger('entry_source_id');
            $table->tinyInteger('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_employee');
    }
};

