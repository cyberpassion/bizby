<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_note', function (Blueprint $table) {
            // Common SaaS fields
            $table->commonSaasFields();

            // Note-specific fields
            $table->string('session', 64)->nullable();
            $table->string('added_for', 255);
            $table->unsignedBigInteger('added_for_id')->nullable();
            $table->string('added_for_type', 64)->nullable();
            $table->string('added_by', 255);
            $table->unsignedBigInteger('added_by_id')->nullable();
            $table->string('added_by_type', 64)->nullable();
            $table->string('note_type', 255)->nullable();
            $table->date('note_end_date')->nullable();
            $table->time('note_end_time')->nullable();
            $table->string('context', 255);
            $table->string('context_type', 64);
            $table->unsignedBigInteger('context_id');
            $table->string('subject', 64)->nullable();
            $table->longText('information')->nullable();
            $table->unsignedBigInteger('thread_parent')->default(0)->nullable();
            $table->text('additional_info')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_note');
    }
};
