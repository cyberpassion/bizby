<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_leaveapplication', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id');
            $table->unsignedBigInteger('leaveapplication_id');
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->string('applicant', 255);
            $table->string('applicant_type', 255)->nullable();
            $table->bigInteger('applicant_id');
            $table->string('session', 255);
            $table->string('month', 255);
            $table->date('leave_date')->nullable();
            $table->string('leave_date_part', 255);
            $table->float('leave_duration')->nullable();
            $table->string('leave_duration_part', 255);
            $table->string('leave_type', 255)->nullable();
            $table->longText('leave_reason')->nullable();
            $table->tinyInteger('is_considered_by_hr')->default(0);
            $table->string('hr_response_remark', 255)->nullable();
            $table->tinyInteger('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_leaveapplication');
    }
};

