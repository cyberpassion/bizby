<?php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_student', function (Blueprint $table) {
            $table->bigInteger('client_id');
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->dateTime('admission_datetime');
            $table->date('admission_date');
            $table->string('admission_id', 64);
            $table->string('registration_id', 64);
            $table->string('is_prospectus_taken', 255);
            $table->string('booklet_number', 255);
            $table->text('registration_remark');
            $table->string('srno_prefix', 255);
            $table->string('sr_no', 64);
            $table->string('class_roll_no', 255);
            $table->string('board_roll_no', 255);
            $table->string('batch', 255);
            $table->string('admission_class', 64);
            $table->string('admission_section', 64);
            $table->string('admission_session', 64);
            $table->string('current_class', 64);
            $table->string('current_section', 64);
            $table->string('current_session', 64);
            $table->string('student_name', 128);
            $table->string('gender', 64);
            $table->date('dob');
            $table->string('religion', 255);
            $table->string('category', 255);
            $table->string('caste', 64);
            $table->string('house_name', 64);
            $table->string('father_name', 128);
            $table->string('phone_number', 64);
            $table->string('email_id', 128);
            $table->string('permanent_address', 255);
            $table->string('father_occupation', 64);
            $table->string('father_annual_income', 64);
            $table->string('father_phone_number', 255);
            $table->string('father_office_address', 255);
            $table->string('mother_name', 128);
            $table->string('mother_occupation', 64);
            $table->string('mother_annual_income', 64);
            $table->string('mother_phone_number', 64);
            $table->string('mother_office_address', 255);
            $table->string('local_guardian_details', 255);
            $table->string('where_you_found_us', 255);
            $table->text('previous_results');
            $table->string('aadhar_number', 64);
            $table->string('pan_number', 255);
            $table->text('documents_submitted');
            $table->text('subjects');
            $table->string('blood_group', 255);
            $table->string('hosteler_or_ds', 255);
            $table->string('hostel_room_no', 255);
            $table->string('parent_portal_access_status', 255);
            $table->text('portal_access');
            $table->string('status_remark', 255);
            $table->string('admission_type', 255);
            $table->bigInteger('punch_id')->nullable();
            $table->string('old_new', 255);
            $table->text('test_packages');
            $table->string('transport_pickup_location', 255);
            $table->string('transport_vehicle_id', 255);
            $table->string('bank_name', 255);
            $table->string('bank_branch_name', 255);
            $table->string('bank_ifsc_code', 255);
            $table->string('bank_account_no', 255);
            $table->string('is_scholarship_provided', 255);
            $table->string('scholarship_no', 255);
            $table->bigInteger('attendance_id')->nullable();
            $table->string('enrollment_no', 255);
            $table->string('file_no', 255);
            $table->string('web_registration_no', 255);
            $table->text('previous_balance_fee');
            $table->string('reference_name', 255);
            $table->text('admission_remark');
            $table->text('class_session_history');
            $table->text('extra_fee_info');
            $table->string('entry_source', 64);
            $table->string('entry_source_type', 64);
            $table->bigInteger('entry_source_id');
            $table->tinyInteger('status');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_student');
    }
};

