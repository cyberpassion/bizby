<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {

    // SaaS common fields
    $table->commonSaasFields();

    // Session
    $table->foreignId('attendance_session_id')
          ->constrained()
          ->cascadeOnDelete();

    // Who attended
    $table->nullableMorphs('entity');
    /*
        Student
        User
        Employee
        Trainee
    */

    // Attendance status
    $table->string('attendance_status')->default('present');
    /*
        present
        absent
        late
        leave
    */

    // Optional timing
    $table->time('in_time')->nullable();
    $table->time('out_time')->nullable();

    // Optional reason / metadata
    $table->string('code')->nullable();
    $table->text('reason')->nullable();

    // Indexes
    $table->index(['attendance_session_id']);
    $table->index(['entity_id', 'entity_type']);
});


    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
