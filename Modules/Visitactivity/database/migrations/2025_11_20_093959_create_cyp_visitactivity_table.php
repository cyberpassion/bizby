<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_visitactivity', function (Blueprint $table) {
            $table->bigInteger('client_id');
            $table->bigIncrements('visitactivity_id'); // Primary key, auto-increment
            $table->date('date');
            $table->dateTime('datetime');
            $table->tinyInteger('visit_status');
            $table->string('visitactivity_parent_id', 64);
            $table->string('visit_by_type', 255);
            $table->bigInteger('visit_by_id');
            $table->bigInteger('created_by_id');
            $table->date('visit_date');
            $table->string('visit_duration_days', 255);
            $table->string('visit_duration_hours', 255);
            $table->string('movement_from', 255);
            $table->string('movement_to', 255);
            $table->string('company_official_name', 255);
            $table->string('company_official_email', 255);
            $table->text('company_official_mobile_number');
            $table->string('company_official_designation', 255);
            $table->string('company_name', 255);
            $table->string('company_nature_of_business', 255);
            $table->text('company_address');
            $table->string('company_city', 255);
            $table->string('company_state', 255);
            $table->string('company_phone_code', 255);
            $table->string('company_phone_number', 255);
            $table->string('company_mobile_code', 255);
            $table->string('company_mobile_number', 255);
            $table->string('company_fax', 255);
            $table->text('company_email');
            $table->string('visited_customer_type', 255);
            $table->text('reason_for_dissatisfaction');
            $table->text('products_discussed');
            $table->text('detailed_report');
            $table->text('next_action_plan');
            $table->text('competitors');
            $table->text('support_required_sales');
            $table->text('support_required_service');
            $table->text('expense_information');
            $table->float('total_expense_amount');
            $table->text('connected_visitplanner_id');
            $table->tinyInteger('connected_visitplanner_sno');
            $table->text('email_to');
            $table->boolean('is_sms_notification_to_send');
            $table->text('visit_status_remark');
            $table->tinyInteger('status');
            $table->bigInteger('visitactivity_group_id')->nullable();
            $table->text('visit_team_member_json')->nullable();
            $table->string('visit_region', 255)->nullable();
            $table->bigInteger('next_visitplanner_id')->nullable();
            $table->bigInteger('next_visitplanner_sno')->nullable();
            $table->date('next_visit_date')->nullable();
            $table->bigInteger('thread_parent')->nullable();
            $table->string('visit_by', 255)->nullable();
            $table->string('created_by_type', 255)->nullable();
            $table->string('created_by', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_visitactivity');
    }
};

