<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_work_histories', function (Blueprint $table) {

            $table->commonSaasFields();

            /* =====================================================
            | RELATION
            ===================================================== */

            $table->foreignId('employee_id')
                ->constrained()
                ->cascadeOnDelete();

            /* =====================================================
            | COMPANY DETAILS
            ===================================================== */

            $table->string('company_name');

            $table->string('designation')->nullable();

            $table->string('department')->nullable();

            $table->string('employment_type')->nullable();
            // Full Time / Part Time / Contract / Internship

            /* =====================================================
            | DURATION
            ===================================================== */

            $table->date('joining_date')->nullable();

            $table->date('relieving_date')->nullable();

            $table->boolean('is_current')->default(false);

            /* =====================================================
            | COMPENSATION
            ===================================================== */

            $table->decimal('salary', 12, 2)->nullable();

            $table->string('salary_currency', 10)
                ->default('INR');

            /* =====================================================
            | WORK DETAILS
            ===================================================== */

            $table->text('job_description')->nullable();

            $table->text('achievements')->nullable();

            $table->text('reason_for_leaving')->nullable();

            /* =====================================================
            | LOCATION
            ===================================================== */

            $table->string('city')->nullable();

            $table->string('state')->nullable();

            $table->string('country')->nullable();

            /* =====================================================
            | DOCUMENTS
            ===================================================== */

            $table->string('experience_letter')->nullable();

            $table->string('salary_slip')->nullable();

            $table->string('offer_letter')->nullable();

            /* =====================================================
            | INDEXES
            ===================================================== */

            $table->index(['employee_id']);

            $table->index(['company_name']);

            $table->index(['designation']);

            $table->index(['is_current']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_work_histories');
    }
};
