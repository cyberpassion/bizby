<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaveapplication_attendance_links', function (Blueprint $table) {

            $table->id();

            // =========================
            // Leave application
            // =========================
            $table->foreignId('leave_application_id')
                  ->constrained('leave_applications')
                  ->cascadeOnDelete();

            // =========================
            // Attendance record
            // =========================
            $table->foreignId('attendance_id')
                  ->constrained('attendances')
                  ->cascadeOnDelete();

            $table->timestamps();

            // =========================
            // Indexes & constraints
            // =========================
            $table->unique(
                ['leave_application_id', 'attendance_id'],
                'uniq_leave_attendance'
            );

            $table->index('leave_application_id');
            $table->index('attendance_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaveapplication_attendance_links');
    }
};
