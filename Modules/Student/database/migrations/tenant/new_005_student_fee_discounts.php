<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'student_fee_discounts',
            function (Blueprint $table) {

                /*
                |--------------------------------------------------------------------------
                | Common SaaS
                |--------------------------------------------------------------------------
                */

                $table->commonSaasFields();

                /*
                |--------------------------------------------------------------------------
                | Student
                |--------------------------------------------------------------------------
                */

                $table->foreignId('student_id')

                    ->nullable()

                    ->constrained()

                    ->cascadeOnDelete();

                /*
                |--------------------------------------------------------------------------
                | Academic Year
                |--------------------------------------------------------------------------
                */

                $table->foreignId('year_id')

                    ->constrained(
                        'student_academic_years'
                    )

                    ->cascadeOnDelete();

                /*
                |--------------------------------------------------------------------------
                | Fee Head
                |--------------------------------------------------------------------------
                */

                $table->foreignId('head_term_id')

                    ->nullable()

                    ->constrained('terms')

                    ->nullOnDelete();

                /*
                |--------------------------------------------------------------------------
                | Optional Pattern Scope
                |--------------------------------------------------------------------------
                */

                $table->foreignId('pattern_id')

                    ->nullable()

                    ->constrained(
                        'student_fee_structure_patterns'
                    )

                    ->nullOnDelete();

                /*
                |--------------------------------------------------------------------------
                | Discount
                |--------------------------------------------------------------------------
                */

                $table->string('name');

                $table->decimal(
                    'amount',
                    10,
                    2
                )->nullable();

                $table->decimal(
                    'percentage',
                    5,
                    2
                )->nullable();

                /*
                |--------------------------------------------------------------------------
                | Optional Period Scope
                |--------------------------------------------------------------------------
                */

                $table->json(
                    'applicable_period_keys'
                )->nullable();

                /*
                |--------------------------------------------------------------------------
                | Extra
                |--------------------------------------------------------------------------
                */

                $table->text('reason')
                    ->nullable();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'student_fee_discounts'
        );
    }
};