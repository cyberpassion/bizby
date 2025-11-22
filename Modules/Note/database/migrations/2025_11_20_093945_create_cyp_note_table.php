<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cyp_note', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id');
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->string('session', 64)->nullable();
            $table->string('added_for', 255);
            $table->bigInteger('added_for_id')->nullable();
            $table->string('added_for_type', 64)->nullable();
            $table->string('added_by', 255);
            $table->bigInteger('added_by_id')->nullable();
            $table->string('added_by_type', 64)->nullable();
            $table->string('note_type', 255)->nullable();
            $table->date('note_end_date')->nullable();
            $table->string('context', 255);
            $table->string('context_type', 64);
            $table->bigInteger('context_id');
            $table->string('subject', 64)->nullable();
            $table->longText('information')->nullable();
            $table->bigInteger('thread_parent')->unsigned()->default(0)->nullable();
            $table->text('additional_info')->nullable();
            $table->tinyInteger('status');
            $table->time('note_end_time')->nullable();

            $table->timestamps(); // Optional: created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cyp_note');
    }
};
