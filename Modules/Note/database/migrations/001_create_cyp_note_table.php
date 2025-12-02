<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_note', function (Blueprint $table) {

            // SaaS Common Fields (client_id, status, created_by, updated_by, deleted_by, timestamps, softDeletes)
            $table->commonSaasFields();

            // Session
            $table->string('session', 64)->nullable();

            // Added For
            $table->unsignedBigInteger('added_for_id')->nullable();
            $table->string('added_for_type', 64)->nullable();
            $table->string('added_for', 255)->nullable();

            // Added By
            $table->unsignedBigInteger('added_by_id')->nullable();
            $table->string('added_by_type', 64)->nullable();
            $table->string('added_by', 255)->nullable();

            // Note Details
            $table->string('note_type')->nullable();
            $table->string('subject', 64)->nullable();
            $table->longText('information')->nullable();
            $table->string('context', 64)->nullable();

            // Context (required earlier → now safer typed)
            $table->string('context_type', 64);
            $table->unsignedBigInteger('context_id');
            $table->unsignedBigInteger('context_type_id')->nullable();

            // Threading
            $table->unsignedBigInteger('thread_parent')->default(0)->nullable();

            // Dates
            $table->date('note_end_date')->nullable();
            $table->time('note_end_time')->nullable();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_note');
    }
};


