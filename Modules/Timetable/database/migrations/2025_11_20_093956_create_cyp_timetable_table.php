<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_timetable', function (Blueprint $table) {
            $table->unsignedBigInteger('id_primary', true); // Primary Key, auto-increment
            $table->unsignedBigInteger('timetable_id');
            $table->string('slot', 255)->nullable();
            $table->string('session', 128)->nullable();
            $table->string('month', 128)->nullable();
            $table->string('class', 255)->nullable();
            $table->string('section', 255)->nullable();
            $table->string('day', 255)->nullable();
            $table->string('subject', 255)->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('teacher', 255)->nullable();
            
            // Common fields
            $table->bigInteger('client_id')->nullable();
            $table->string('recipient', 64)->nullable();
            $table->string('allotted_to', 255)->nullable();
            $table->string('allotted_to_type', 64)->nullable();
            $table->bigInteger('allotted_to_type_id')->nullable();

            // Optional timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_timetable');
    }
};
