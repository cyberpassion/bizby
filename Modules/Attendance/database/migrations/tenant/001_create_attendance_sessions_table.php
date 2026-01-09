<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_sessions', function (Blueprint $table) {

    // SaaS common fields
    $table->commonSaasFields();

    // Session identity
    $table->string('type');
    /*
        day        → school day-wise
        lecture    → college/coaching
        shift      → office/factory
        event      → seminar/workshop
    */

    // When
    $table->date('session_date');
    $table->time('start_time')->nullable();
    $table->time('end_time')->nullable();

    // Context (generic, NOT education-specific)
    $table->string('context')->nullable();
    /*
        examples:
        "Classroom A"
        "Batch Morning"
        "Room 204"
        "Online Zoom"
    */

    // Optional reference
    $table->string('reference')->nullable();
    /*
        examples:
        "Period 1"
        "Lecture 5"
        "Morning Session"
    */

    // Who took attendance
    $table->nullableMorphs('taken_by');
    // User | Employee | Teacher | System

    // Indexes
    $table->index(['session_date']);
});

    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_sessions');
    }
};
