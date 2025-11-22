<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_leaveapplication', function (Blueprint $table) {
            // Common SaaS fields
            $table->commonSaasFields();

            // Leave application-specific fields
            $table->unsignedBigInteger('leaveapplication_id')->nullable();
            $table->string('session', 64)->nullable();
            $table->string('month', 64)->nullable();
            $table->date('leave_date')->nullable();
            $table->string('leave_date_part', 64)->nullable();
            $table->float('leave_duration')->nullable();
            $table->string('leave_duration_part', 64)->nullable();
            $table->string('leave_type', 128)->nullable();
            $table->longText('leave_reason')->nullable();
            $table->tinyInteger('is_considered_by_hr')->default(0);
            $table->string('hr_response_remark', 255)->nullable();

            // Polymorphic applicant reference
            $table->string('applicant_type', 64)->nullable();
            $table->unsignedBigInteger('applicant_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_leaveapplication');
    }
};


