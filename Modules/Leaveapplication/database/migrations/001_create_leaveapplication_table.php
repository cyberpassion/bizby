<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaveapplications', function (Blueprint $table) {

            // =========================
            // Common SaaS fields
            // =========================
            /*
                id
                client_id
                status
                created_by
                updated_by
                deleted_by
                timestamps
                soft deletes
            */
            $table->commonSaasFields();

            // =========================
            // Who is applying for leave
            // =========================
            $table->nullableMorphs('entity');
            /*
                Student
                Employee
                User
            */

            // =========================
            // Leave period
            // =========================
            $table->date('start_date');
            $table->date('end_date');
            /*
                single day or multi-day leave
            */

            // =========================
            // Leave granularity
            // =========================
            $table->string('type')->nullable();
            /*
                full_day
                half_day
                session
            */

            $table->string('session_ref')->nullable();
            /*
                Morning
                Period 3
                Lecture 5
            */

            // =========================
            // Leave classification
            // =========================
            $table->string('leave_code')->nullable();
            /*
                casual
                sick
                paid
                unpaid
                exam
            */

            // =========================
            // Reason & attachments
            // =========================
            $table->text('reason')->nullable();

            // =========================
            // Approval workflow
            // =========================
            $table->string('approval_status')->default('pending');
            /*
                pending
                approved
                rejected
                cancelled
            */

            $table->nullableMorphs('approved_by');
            $table->dateTime('approved_at')->nullable();

            // =========================
            // Attendance integration
            // =========================
            $table->boolean('affects_attendance')->default(true);

            // =========================
            // Extra metadata
            // =========================
            $table->json('meta')->nullable();

            // =========================
            // Indexes
            // =========================
            $table->index(['start_date', 'end_date']);
            $table->index(['entity_id', 'entity_type']);
            $table->index('approval_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaveapplications');
    }
};
