<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {

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
            // Thread reference
            // =========================
            $table->foreignId('note_thread_id')
                  ->constrained('note_threads')
                  ->cascadeOnDelete();

            // =========================
            // Sender & receiver
            // =========================
            $table->nullableMorphs('sender');
            /*
                Student
                User
                Employee
                Institute
            */

            $table->nullableMorphs('receiver');
            /*
                Student
                User
                Employee
                Institute
            */

            // =========================
            // Message content
            // =========================
            $table->text('message')->nullable();

            // =========================
            // Message type
            // =========================
            $table->string('message_type')->default('text');
            /*
                text
                system
                attachment
            */

            // =========================
            // Read / delivery status
            // =========================
            $table->timestamp('read_at')->nullable();

            /*
                attachments
                links
                system flags
            */

            // =========================
            // Indexes
            // =========================
            $table->index('note_thread_id');
            $table->index(['sender_id', 'sender_type']);
            $table->index(['receiver_id', 'receiver_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
