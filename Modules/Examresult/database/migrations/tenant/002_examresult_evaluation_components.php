<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('examresult_evaluation_components', function (Blueprint $table) {

            $table->id();

            // =========================
            // Parent evaluation
            // =========================
            $table->foreignId('evaluation_id')
                  ->constrained('examresult_evaluations')
                  ->cascadeOnDelete();
            /*
                Each evaluation can have multiple components
                (subjects, papers, sections, criteria)
            */

            // =========================
            // Component identity
            // =========================
            $table->string('name');
            /*
                Maths
                Physics
                Section A
                Practical
                Theory
            */

            $table->string('code')->nullable();
            /*
                MATH
                PHY
                SEC_A
                PRACT
            */

            // =========================
            // Scoring
            // =========================
            $table->decimal('max_score', 8, 2)->nullable();
            /*
                Maximum marks for this component
            */

            // =========================
            // Extra configuration
            // =========================
            $table->json('meta')->nullable();
            /*
                internal / external
                weightage
                optional / compulsory
            */

            $table->timestamps();

            // =========================
            // Indexes
            // =========================
            $table->index('evaluation_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examresult_evaluation_components');
    }
};
