<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_students', function (Blueprint $table) {

            //  Common SaaS Fields
            $table->commonSaasFields(); // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

            //  Student Specific Fields
            $table->dateTime('admission_datetime');
            $table->dateTime('registration_datetime');

            $table->date('admission_date');
            $table->date('registration_date');

            $table->string('admission_id', 64);
            $table->string('registration_id', 64);

            $table->string('is_prospectus_taken');
            $table->string('booklet_number');

            $table->text('registration_remark');

            $table->string('sr_no', 64);
            $table->string('old_sr_no');
            $table->string('class_roll_no');
            $table->string('board_roll_no');
            $table->string('batch');
            $table->string('admission_class', 64);
            $table->string('admission_section', 64);
            $table->string('admission_session', 64);

            $table->string('current_class', 64);
            $table->string('current_section', 64);
            $table->string('current_session', 64);

            // Patient/person info using macro
            $table->commonPersonFields();

            $table->string('religion');
            $table->string('category');
            $table->string('caste', 64);
            $table->string('house_name', 64);

            $table->string('father_name', 128);

            $table->string('father_occupation', 64);
            $table->string('father_annual_income', 64);
            $table->string('father_phone_number');
            $table->string('father_office_address');

            $table->string('mother_name', 128);
            $table->string('mother_occupation', 64);
            $table->string('mother_annual_income', 64);
            $table->string('mother_phone_number', 64);
            $table->string('mother_office_address');

            $table->string('local_guardian_details');

            $table->text('previous_results');

            $table->text('documents_submitted');
            $table->text('subjects');

            $table->string('blood_group');
            $table->string('hosteler_or_ds');
            $table->string('hostel_room_no');

            $table->string('parent_portal_access_status');

            $table->text('portal_access');

            $table->string('status_remark');
            $table->string('admission_type');

            $table->bigInteger('punch_id')->nullable();

            $table->string('old_new');

            $table->string('transport_pickup_location');
            $table->string('transport_vehicle_id');

            $table->string('bank_name');
            $table->string('bank_branch_name');
            $table->string('bank_ifsc_code');
            $table->string('bank_account_no');

            $table->string('is_scholarship_provided');
            $table->string('scholarship_no');

            $table->bigInteger('attendance_id')->nullable();

            $table->string('enrollment_no');
            $table->string('file_no');
            $table->string('web_registration_no');

            $table->text('previous_balance_fee');

            $table->string('reference_name');

            $table->text('admission_remark');

            $table->text('class_session_history');

            $table->string('where_you_found_us')->nullable();
            $table->string('srno_prefix')->nullable();

            $table->text('extra_fee_info')->nullable();

            $table->string('entry_source', 64)->nullable();
            $table->string('entry_source_type', 64)->nullable();
            $table->bigInteger('entry_source_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_student');
    }
};
