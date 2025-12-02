<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cyp_employees', function (Blueprint $table) {

            // Common SaaS Fields
            $table->commonSaasFields();
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

            $table->string('employee_type', 255);
            $table->string('session', 64);

			// Patient/person info using macro
            $table->commonPersonFields();

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

            $table->string('current_address', 255);
            $table->string('designation', 255);

            $table->date('date_of_joining');
            $table->date('date_of_relieving')->nullable();

            $table->text('past_work_experience');
            $table->text('portal_access');
            $table->tinyInteger('status');

            $table->unsignedBigInteger('punch_id')->nullable();

            $table->string('teaching_exam_qualified', 255)->nullable();
            $table->string('secondary_passing_year', 255)->nullable();
            $table->string('secondary_passing_roll_no', 255)->nullable();

            $table->string('qualification_level', 255)->nullable();
            $table->string('educational_qualification', 255)->nullable();
            $table->string('professional_qualification', 255)->nullable();

            $table->text('job_location')->nullable();
            $table->text('job_responsibility')->nullable();

            $table->string('first_salary', 8000)->nullable();
			$table->string('current_salary', 8);
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
