<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('student_transitions', function (Blueprint $table) {

            $table->id();

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
            | Transition Type
            |--------------------------------------------------------------------------
            */

            $table->enum('transition_type', [
                'promotion',
                'demotion',
                'transfer',
                'retain',
                'graduate',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Source Academic Structure
            |--------------------------------------------------------------------------
            */

            $table->foreignId('source_year_id')
                ->constrained('student_academic_years');

            $table->foreignId('source_class_term_id')
                ->constrained('terms');

            $table->foreignId('source_section_term_id')
                ->constrained('terms');

            /*
            |--------------------------------------------------------------------------
            | Target Academic Structure
            |--------------------------------------------------------------------------
            */

            $table->foreignId('target_year_id')
                ->constrained('student_academic_years');

            $table->foreignId('target_class_term_id')
                ->constrained('terms');

            $table->foreignId('target_section_term_id')
                ->constrained('terms');

            /*
            |--------------------------------------------------------------------------
            | Transition Info
            |--------------------------------------------------------------------------
            */

            $table->date('effective_from')
                ->nullable();

            $table->string('status')
                ->default('completed');

            $table->text('remarks')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Audit
            |--------------------------------------------------------------------------
            */

            $table->foreignId('processed_by')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_transitions');
    }
};