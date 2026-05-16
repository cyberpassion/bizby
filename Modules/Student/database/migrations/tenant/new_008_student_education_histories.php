<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_education_histories', function (Blueprint $table) {

            $table->commonSaasFields();

            /* =====================================================
            | RELATION
            ===================================================== */

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            /* =====================================================
            | INSTITUTION DETAILS
            ===================================================== */

            $table->string('institution_name');

            $table->string('institution_type')
                ->nullable();
            // school
            // college
            // university
            // coaching
            // academy
            // training_center

            $table->text('institution_address')
                ->nullable();

            $table->string('city')
                ->nullable();

            $table->string('state')
                ->nullable();

            $table->string('country')
                ->nullable();

            /* =====================================================
            | PROGRAM DETAILS
            ===================================================== */

            $table->string('program_name')
                ->nullable();
            // Class 10
            // B.Tech
            // MBA
            // JEE Batch

            $table->string('specialization')
                ->nullable();
            // Science
            // Commerce
            // Mechanical
            // NEET

            $table->string('board_university')
                ->nullable();
            // CBSE
            // ICSE
            // AKTU
            // Delhi University

            $table->string('medium')
                ->nullable();

            /* =====================================================
            | STUDENT DETAILS
            ===================================================== */

            $table->string('roll_number')
                ->nullable();

            $table->string('admission_number')
                ->nullable();

            $table->string('registration_number')
                ->nullable();

            /* =====================================================
            | ACADEMIC RESULT
            ===================================================== */

            $table->decimal('percentage', 5, 2)
                ->nullable();

            $table->decimal('cgpa', 5, 2)
                ->nullable();

            $table->string('grade')
                ->nullable();

            $table->string('result_status')
                ->nullable();
            // passed
            // failed
            // promoted
            // detained

            $table->year('passing_year')
                ->nullable();

            /* =====================================================
            | DURATION
            ===================================================== */

            $table->date('from_date')
                ->nullable();

            $table->date('to_date')
                ->nullable();

            $table->boolean('is_current')
                ->default(false);

            /* =====================================================
            | SUBJECTS / EXTRA
            ===================================================== */

            $table->json('subjects')
                ->nullable();

            $table->text('achievements')
                ->nullable();

            $table->text('remarks')
                ->nullable();

            $table->text('reason_for_leaving')
                ->nullable();

            /* =====================================================
            | DOCUMENTS
            ===================================================== */

            $table->string('marksheet')
                ->nullable();

            $table->string('transfer_certificate')
                ->nullable();

            $table->string('migration_certificate')
                ->nullable();

            $table->string('certificate')
                ->nullable();

            $table->string('id_card')
                ->nullable();

            /* =====================================================
            | INDEXES
            ===================================================== */

            $table->index(['student_id']);

            $table->index(['institution_name']);

            $table->index(['institution_type']);

            $table->index(['program_name']);

            $table->index(['specialization']);

            $table->index(['board_university']);

            $table->index(['passing_year']);

            $table->index(['is_current']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_education_histories');
    }
};