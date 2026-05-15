<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'student_fee_structure_overrides',
            function (Blueprint $table) {

                /*
                |--------------------------------------------------------------------------
                | Common SaaS Fields
                |--------------------------------------------------------------------------
                */

                $table->commonSaasFields();

                /*
                |--------------------------------------------------------------------------
                | Student
                |--------------------------------------------------------------------------
                |
                | Override applies only to this student.
                |
                */

                $table->foreignId('student_id')

                    ->constrained()

                    ->cascadeOnDelete();

                /*
                |--------------------------------------------------------------------------
                | Optional Base Structure Reference
                |--------------------------------------------------------------------------
                |
                | Useful for traceability / audits.
                |
                */

                $table->foreignId('fee_structure_id')

                    ->nullable()

                    ->constrained(
                        'student_fee_structures'
                    )

                    ->nullOnDelete();

                /*
                |--------------------------------------------------------------------------
                | Pattern
                |--------------------------------------------------------------------------
                */

                $table->foreignId('pattern_id')

                    ->nullable()

                    ->constrained(
                        'student_fee_structure_patterns'
                    );

                /*
                |--------------------------------------------------------------------------
                | Amount Type
                |--------------------------------------------------------------------------
                */

                $table->enum('amount_type', [

                    'per_period',

                    'total',

                ])->default('per_period');

                /*
                |--------------------------------------------------------------------------
                | Context
                |--------------------------------------------------------------------------
                */

                $table->foreignId('year_id')

                    ->constrained(
                        'student_academic_years'
                    )

                    ->cascadeOnDelete();

                $table->foreignId('class_term_id')

                    ->constrained('terms')

                    ->cascadeOnDelete();

                $table->foreignId('section_term_id')

                    ->nullable()

                    ->constrained('terms')

                    ->nullOnDelete();

                /*
                |--------------------------------------------------------------------------
                | Fee Head
                |--------------------------------------------------------------------------
                */

                $table->foreignId('head_term_id')

                    ->constrained('terms')

                    ->cascadeOnDelete();

                /*
                |--------------------------------------------------------------------------
                | Amount
                |--------------------------------------------------------------------------
                */

                $table->decimal(
                    'amount',
                    10,
                    2
                )->default(0);

                /*
                |--------------------------------------------------------------------------
                | Extra
                |--------------------------------------------------------------------------
                */

                $table->string('reason')
                    ->nullable();

                /*
                |--------------------------------------------------------------------------
                | Prevent Duplicate Override
                |--------------------------------------------------------------------------
                */

                $table->unique([

                    'student_id',

                    'year_id',

                    'head_term_id',

                ], 'uniq_student_fee_override');
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'student_fee_structure_overrides'
        );
    }
};