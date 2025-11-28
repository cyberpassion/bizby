<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_leaveapplication', function (Blueprint $table) {

            // Primary Key
            $table->id(); // standard primary key

            // SaaS Common Fields
            $table->commonSaasFields();

            // Leave Application Fields
            $table->unsignedBigInteger('leaveapplication_id');

            // Applicant Info
            $table->string('applicant_type', 255)->nullable();
            $table->unsignedBigInteger('applicant_id')->nullable();
            $table->string('applicant')->nullable();

            // Session Details
            $table->string('session', 255);
            $table->string('month', 255);

            // Leave Date & Duration
            $table->date('leave_date')->nullable();
            $table->string('leave_date_part', 255)->nullable();

            $table->float('leave_duration')->nullable();
            $table->string('leave_duration_part', 255)->nullable();

            // Leave Details
            $table->string('leave_type', 255)->nullable();
            $table->longText('leave_reason')->nullable();

            // HR Review
            $table->boolean('is_considered_by_hr')->default(0);
            $table->string('hr_response_remark', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_leaveapplication');
    }
};

