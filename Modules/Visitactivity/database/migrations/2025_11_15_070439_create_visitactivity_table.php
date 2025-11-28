<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_visitactivity', function (Blueprint $table) {

            // Primary Key
            $table->id('visitactivity_id');

            // Common SaaS fields: client_id, status, audit fields, softDeletes, timestamps
            $table->commonSaasFields();

            // Visit Details
            $table->tinyInteger('visit_status');
            $table->unsignedBigInteger('visitactivity_parent_id')->nullable();
            $table->string('visit_by_type', 255);
            $table->unsignedBigInteger('visit_by_id');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->date('visit_date');
            $table->string('visit_duration_days', 255)->nullable();
            $table->string('visit_duration_hours', 255)->nullable();

            // Movement & Company Info
            $table->string('movement_from', 255)->nullable();
            $table->string('movement_to', 255)->nullable();
            $table->string('company_official_name', 255)->nullable();
            $table->string('company_official_email', 255)->nullable();
            $table->string('company_official_mobile_number')->nullable();
            $table->string('company_official_designation', 255)->nullable();
            $table->string('company_name', 255)->nullable();
            $table->string('company_nature_of_business', 255)->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_city', 255)->nullable();
            $table->string('company_state', 255)->nullable();
            $table->string('company_phone_code', 255)->nullable();
            $table->string('company_phone_number', 255)->nullable();
            $table->string('company_mobile_code', 255)->nullable();
            $table->string('company_mobile_number', 255)->nullable();
            $table->string('company_fax', 255)->nullable();
            $table->string('company_email', 255)->nullable();

            // Visit Analysis & Reports
            $table->string('visited_customer_type', 255)->nullable();
            $table->longText('reason_for_dissatisfaction')->nullable();
            $table->longText('products_discussed')->nullable();
            $table->longText('detailed_report')->nullable();
            $table->longText('next_action_plan')->nullable();
            $table->longText('competitors')->nullable();
            $table->longText('support_required_sales')->nullable();
            $table->longText('support_required_service')->nullable();
            $table->longText('expense_information')->nullable();
            $table->float('total_expense_amount')->nullable();
            $table->unsignedBigInteger('connected_visitplanner_id')->nullable();
            $table->unsignedTinyInteger('connected_visitplanner_sno')->nullable();
            $table->string('email_to')->nullable();
            $table->tinyInteger('is_sms_notification_to_send')->nullable();
            $table->longText('visit_status_remark')->nullable();

            // Follow-up & Hierarchy
            $table->unsignedBigInteger('visitactivity_group_id')->nullable();
            $table->longText('visit_team_member_json')->nullable();
            $table->string('visit_region', 255)->nullable();
            $table->unsignedBigInteger('next_visitplanner_id')->nullable();
            $table->unsignedBigInteger('next_visitplanner_sno')->nullable();
            $table->date('next_visit_date')->nullable();
            $table->unsignedBigInteger('thread_parent')->nullable();

            // Optional: human-readable fields
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


