<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_visitplanner', function (Blueprint $table) {

            // Common SaaS fields: client_id, status, audit fields, softDeletes, timestamps
            $table->commonSaasFields();

            // Planner Details
            $table->unsignedBigInteger('visitplanner_id')->nullable();
            $table->string('visit_by_type', 64);
            $table->unsignedBigInteger('visit_by_id');
            $table->unsignedBigInteger('created_by_id')->nullable();

            $table->string('session', 64);
            $table->string('month', 64);
            $table->string('week', 64);
            $table->longText('visitplanner_data')->nullable();
            $table->longText('visit_team_member_json')->nullable();

            // Schedule Details
            $table->date('visit_date')->nullable();
            $table->time('visit_time')->nullable();

            // Location & Company Info
            $table->string('state', 64)->nullable();
            $table->text('district')->nullable();
            $table->text('visit_address')->nullable();
            $table->text('visit_company')->nullable();
            $table->string('visit_company_type', 64)->nullable();
            $table->text('visit_meetingwith')->nullable();
            $table->string('visit_email', 255)->nullable();
            $table->string('visit_mobile_number', 255)->nullable();
            $table->string('visit_website', 255)->nullable();
            $table->text('visit_product')->nullable();

            // Visit Purpose & Info
            $table->text('visit_reason')->nullable();
            $table->text('visit_expectation')->nullable();
            $table->text('visit_expectedexpense')->nullable();

            // Entry & Audit
            $table->string('visit_by', 255)->nullable();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_visitplanner');
    }
};
