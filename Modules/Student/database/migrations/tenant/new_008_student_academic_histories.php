<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_academic_histories', function (Blueprint $table) {

            $table->id();

            $table->commonSaasFields();

            /* =====================================================
            | RELATION
            ===================================================== */

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            /* =====================================================
            | SCHOOL DETAILS
            ===================================================== */

            $table->string('school_name');

            $table->string('board')->nullable();
            // CBSE / ICSE / State / IB

            $table->string('medium')->nullable();

            /* =====================================================
            | CLASS DETAILS
            ===================================================== */

            $table->string('class_name')->nullable();

            $table->string('roll_number')->nullable();

            $table->string('admission_number')->nullable();

            /* =====================================================
            | ACADEMIC DETAILS
            ===================================================== */

            $table->decimal('percentage', 5, 2)->nullable();

            $table->decimal('cgpa', 5, 2)->nullable();

            $table->string('grade')->nullable();

            $table->year('passing_year')->nullable();

            /* =====================================================
            | DURATION
            ===================================================== */

            $table->date('from_date')->nullable();

            $table->date('to_date')->nullable();

            /* =====================================================
            | EXTRA
            ===================================================== */

            $table->text('remarks')->nullable();

            $table->text('achievements')->nullable();

            /* =====================================================
            | DOCUMENTS
            ===================================================== */

            $table->string('marksheet')->nullable();

            $table->string('transfer_certificate')->nullable();

            $table->string('migration_certificate')->nullable();

            /* =====================================================
            | INDEXES
            ===================================================== */

            $table->index(['student_id']);

            $table->index(['school_name']);

            $table->index(['passing_year']);

            $table->index(['board']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_academic_histories');
    }
};