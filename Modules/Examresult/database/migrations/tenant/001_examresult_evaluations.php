<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('examresult_evaluations', function (Blueprint $table) {

            // =========================
            // Common SaaS fields
            // =========================
            /*
                Typically includes:
                id
                client_id
                status
                created_by
                updated_by
                deleted_by
                timestamps
                soft deletes
            */
            $table->commonSaasFields();

            // =========================
            // Evaluation identity
            // =========================
            $table->string('name');
            /*
                Examples:
                Unit Test 1
                Mid Term
                Final Exam
                Mock Test 3
            */

            $table->string('type')->nullable();
            /*
                exam
                test
                assessment
                review
                audit
            */

            // =========================
            // Grouping for combined reports
            // =========================
            $table->string('group_code')->nullable();
            /*
                Used to combine multiple exams together
                Examples:
                2024_ANNUAL
                SEM_1
                TERM_2
                FY2025
            */

            // Order inside the group
            $table->unsignedInteger('sequence')->nullable();
            /*
                Helps order exams in reports:
                Unit Test 1 → 1
                Unit Test 2 → 2
                Final Exam → 3
            */

            // =========================
            // When the evaluation happened
            // =========================
            $table->date('evaluation_date')->nullable();

            /*
                weightage
                grading rules
                passing criteria
                internal / external flags
            */

            // =========================
            // Indexes
            // =========================
            $table->index('group_code');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examresult_evaluations');
    }
};
