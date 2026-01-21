<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('examresult_evaluation_results', function (Blueprint $table) {

            // =========================
            // Common SaaS fields
            // =========================
            $table->commonSaasFields();

            // =========================
            // Evaluation reference
            // =========================
            $table->foreignId('evaluation_id')
                  ->constrained('examresult_evaluations')
                  ->cascadeOnDelete();

            // =========================
            // Optional component reference
            // =========================
            $table->foreignId('evaluation_component_id')
                  ->nullable()
                  ->constrained('examresult_evaluation_components')
                  ->nullOnDelete();
            /*
                Null means:
                - Overall score (no subject breakdown)
            */

            // =========================
            // Who is being evaluated
            // =========================
            $table->nullableMorphs('entity');
            /*
                Student
                User
                Employee
                Candidate
            */

            // =========================
            // Raw score (atomic data)
            // =========================
            $table->decimal('score', 8, 2)->nullable();
            $table->decimal('max_score', 8, 2)->nullable();

            // =========================
            // Qualitative outcome
            // =========================
            $table->string('grade')->nullable();
            /*
                A, B, C
                Distinction
                Excellent
            */

            $table->string('result_status')->nullable();
            /*
                pass
                fail
                absent
                evaluated
            */

            // =========================
            // Indexes
            // =========================
            $table->index(['evaluation_id']);
            $table->index(['entity_id', 'entity_type']);

            // =========================
            // Prevent duplicate results
            // =========================
            $table->unique([
                'evaluation_id',
                'evaluation_component_id',
                'entity_id',
                'entity_type'
            ], 'uniq_examresult_entity_score');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examresult_evaluation_results');
    }
};
