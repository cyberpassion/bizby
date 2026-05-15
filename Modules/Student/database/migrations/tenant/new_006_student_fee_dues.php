<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'student_fee_dues',
            function (Blueprint $table) {

                /*
                |--------------------------------------------------------------------------
                | Common SaaS Fields
                |--------------------------------------------------------------------------
                */

                $table->commonSaasFields();

                /*
                |--------------------------------------------------------------------------
                | Student / Academic
                |--------------------------------------------------------------------------
                */

                $table->foreignId('student_id')
                    ->constrained('students')
                    ->cascadeOnDelete();

                $table->foreignId('year_id')
                    ->constrained('student_academic_years')
                    ->cascadeOnDelete();

                $table->foreignId('class_term_id')
                    ->nullable()
                    ->constrained('terms');

                $table->foreignId('section_term_id')
                    ->nullable()
                    ->constrained('terms');

                /*
                |--------------------------------------------------------------------------
                | Structure
                |--------------------------------------------------------------------------
                */

                $table->foreignId('structure_id')
                    ->nullable()
                    ->constrained('student_fee_structures')
                    ->nullOnDelete();

                $table->foreignId('head_term_id')
                    ->nullable()
                    ->constrained('terms');

                $table->foreignId('pattern_period_id')
                    ->nullable()
                    ->constrained(
                        'student_fee_structure_pattern_periods'
                    );

                /*
                |--------------------------------------------------------------------------
                | Due Type
                |--------------------------------------------------------------------------
                */

                $table->enum('due_type', [

                    'fee',

                    'carry_forward',

                    'adjustment',

                    'fine',

                ])->default('fee');

                /*
                |--------------------------------------------------------------------------
                | Amounts
                |--------------------------------------------------------------------------
                */

                $table->decimal('amount', 12, 2)
                    ->default(0);

                $table->decimal('paid_amount', 12, 2)
                    ->default(0);

                $table->decimal('waiver_amount', 12, 2)
                    ->default(0);

                $table->decimal('fine_amount', 12, 2)
                    ->default(0);

                $table->decimal('balance_amount', 12, 2)
                    ->default(0);

                /*
                |--------------------------------------------------------------------------
                | Dates
                |--------------------------------------------------------------------------
                */

                $table->date('due_date')
                    ->nullable();

                $table->timestamp('generated_at')
                    ->nullable();

                /*
                |--------------------------------------------------------------------------
                | Status
                |--------------------------------------------------------------------------
                */

                $table->enum('dues_status', [

                    'unpaid',

                    'partial',

                    'paid',

                    'cancelled',

                ])->default('unpaid');

                $table->boolean('is_generated')
                    ->default(true);

                /*
                |--------------------------------------------------------------------------
                | Snapshots
                |--------------------------------------------------------------------------
                */

                $table->string('head_name')
                    ->nullable();

                $table->string('pattern_name')
                    ->nullable();

                $table->string('period_name')
                    ->nullable();

                /*
                |--------------------------------------------------------------------------
                | Extra
                |--------------------------------------------------------------------------
                */

                $table->foreignId('source_year_id')
                    ->nullable()
                    ->constrained('student_academic_years')
                    ->nullOnDelete();

                /*
                |--------------------------------------------------------------------------
                | Indexes
                |--------------------------------------------------------------------------
                */

                $table->index([

                    'student_id',

                    'dues_status',
                ]);

                $table->index([
                    'due_date'
                ]);

                $table->index([
                    'year_id'
                ]);

                /*
                |--------------------------------------------------------------------------
                | Prevent Duplicate Dues
                |--------------------------------------------------------------------------
                */

                $table->unique([

                    'student_id',

                    'year_id',

                    'head_term_id',

                    'pattern_period_id',

                ], 'student_due_unique');
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'student_fee_dues'
        );
    }
};