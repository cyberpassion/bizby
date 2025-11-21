<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_student', function (Blueprint $table) {

            $table->id(); // primary key

            $table->unsignedBigInteger('client_id');

            // Dates
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();

            $table->dateTime('admission_datetime');
            $table->date('admission_date');

            // Admission + Registration
            $table->string('admission_id', 64);
            $table->string('registration_id', 64);

            $table->string('is_prospectus_taken')->nullable();
            $table->string('booklet_number')->nullable();
            $table->text('registration_remark')->nullable();

            // SERIAL NUMBERS
            $table->string('srno_prefix')->nullable();
            $table->string('sr_no', 64);
            $table->string('class_roll_no')->nullable();
            $table->string('board_roll_no')->nullable();

            // Academic
            $table->string('batch')->nullable();
            $table->string('admission_class', 64);
            $table->string('admission_section', 64);
            $table->string('admission_session', 64);
            $table->string('current_class', 64);
            $table->string('current_section', 64);
            $table->string('current_session', 64);

            // Student Details
            $table->string('student_name', 128);
            $table->string('gender', 64);
            $table->date('dob');
            $table->string('religion')->nullable();
            $table->string('category')->nullable();
            $table->string('caste', 64)->nullable();
            $table->string('house_name', 64)->nullable();

            // Contact
            $table->string('phone_number', 64)->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();

            // Father
            $table->string('father_name', 128)->nullable();
            $table->string('father_occupation', 64)->nullable();
            $table->string('father_annual_income', 64)->nullable();
            $table->string('father_phone_number', 32)->nullable();
            $table->string('father_office_address')->nullable();

            // Mother
            $table->string('mother_name', 128)->nullable();
            $table->string('mother_occupation', 64)->nullable();
            $table->string('mother_annual_income', 64)->nullable();
            $table->string('mother_phone_number', 32)->nullable();
            $table->string('mother_office_address')->nullable();

            // Misc
            $table->string('local_guardian_details')->nullable();
            $table->string('where_you_found_us')->nullable();
            $table->text('previous_results')->nullable();
            $table->string('aadhar_number', 64)->nullable();
            $table->string('pan_number')->nullable();

            // Documents & Subjects
            $table->text('documents_submitted')->nullable();
            $table->text('subjects')->nullable();

            // Health
            $table->string('blood_group')->nullable();

            // Hostel
            $table->string('hosteler_or_ds')->nullable();
            $table->string('hostel_room_no')->nullable();

            // Portal
            $table->string('parent_portal_access_status')->nullable();
            $table->text('portal_access')->nullable();

            $table->string('status_remark')->nullable();
            $table->string('admission_type')->nullable();

            // Punch & Attendance
            $table->unsignedBigInteger('punch_id')->nullable();
            $table->unsignedBigInteger('attendance_id')->nullable();

            // Misc Student data
            $table->string('old_new')->nullable();
            $table->text('test_packages')->nullable();

            // Transport
            $table->string('transport_pickup_location')->nullable();
            $table->string('transport_vehicle_id')->nullable();

            // Bank
            $table->string('bank_name')->nullable();
            $table->string('bank_branch_name')->nullable();
            $table->string('bank_ifsc_code')->nullable();
            $table->string('bank_account_no')->nullable();

            // Scholarship
            $table->string('is_scholarship_provided')->nullable();
            $table->string('scholarship_no')->nullable();

            // Extra
            $table->string('enrollment_no')->nullable();
            $table->string('file_no')->nullable();
            $table->string('web_registration_no')->nullable();
            $table->text('previous_balance_fee')->nullable();
            $table->string('reference_name')->nullable();
            $table->text('admission_remark')->nullable();
            $table->text('class_session_history')->nullable();
            $table->text('extra_fee_info')->nullable();

            // Entry Source
            $table->string('entry_source', 64)->nullable();
            $table->string('entry_source_type', 64)->nullable();
            $table->unsignedBigInteger('entry_source_id')->nullable();

            $table->tinyInteger('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_student');
    }
};
