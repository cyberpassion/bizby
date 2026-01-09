<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('note_threads', function (Blueprint $table) {

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
            // Conversation participants
            // =========================
            $table->nullableMorphs('participant_one');
            /*
                Student
                User
                Employee
                Customer
            */

            $table->nullableMorphs('participant_two');
            /*
                Institute
                Admin
                Business
                User
            */

            // =========================
            // Thread metadata
            // =========================
            $table->string('type')->nullable();
            /*
                support
                enquiry
                internal
                personal
            */

            $table->string('subject')->nullable();
            /*
                Admission Query
                Payment Issue
                General Discussion
            */

            $table->timestamp('last_message_at')->nullable();

            // =========================
            // Indexes
            // =========================
            $table->index(['participant_one_id', 'participant_one_type']);
            $table->index(['participant_two_id', 'participant_two_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('note_threads');
    }
};
