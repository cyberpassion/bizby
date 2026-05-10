<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fee_dues', function (Blueprint $table) {

            $table->commonSaasFields();

            /*
            |--------------------------------------------------------------------------
            | Student
            |--------------------------------------------------------------------------
            */

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Academic Context
            |--------------------------------------------------------------------------
            */

            $table->foreignId('year_id')
                ->constrained('student_academic_years');

            $table->foreignId('class_term_id')
                ->constrained('terms');

            $table->foreignId('section_term_id')
                ->constrained('terms');

            /*
            |--------------------------------------------------------------------------
            | Fee Structure
            |--------------------------------------------------------------------------
            */

            $table->foreignId('fee_structure_id')
                ->nullable()
                ->constrained('student_fee_structures');

            /*
            |--------------------------------------------------------------------------
            | Due Type
            |--------------------------------------------------------------------------
            */

            $table->enum('due_type', [

                'fee',
                'carry_forward',
                'adjustment',

            ])->default('fee');

            /*
            |--------------------------------------------------------------------------
            | Fee Context
            |--------------------------------------------------------------------------
            */

            $table->string('period')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Amounts
            |--------------------------------------------------------------------------
            */

            $table->decimal('total_amount', 10, 2);

            $table->decimal('discount_amount', 10, 2)
                ->default(0);

            $table->decimal('paid_amount', 10, 2)
                ->default(0);

            $table->decimal('due_amount', 10, 2)
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | Carry Forward
            |--------------------------------------------------------------------------
            */

            $table->foreignId('source_year_id')
                ->nullable()
                ->constrained('student_academic_years');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_dues');
    }
};