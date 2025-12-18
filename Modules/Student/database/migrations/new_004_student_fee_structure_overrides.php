<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fee_structure_overrides', function (Blueprint $table) {
            $table->id();

            // Student for whom the override applies
            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            // Base fee structure being overridden
            $table->foreignId('fee_structure_id')
                ->constrained('student_fee_structures')
                ->cascadeOnDelete();

            /**
             * Override values
             *
             * Use ONE of the following:
             * 1. override_amount  → flat replacement amount
             * 2. selected_periods → per-period replacement
             */

            // Flat override (e.g., tuition becomes 500/month)
            $table->decimal('override_amount', 10, 2)->nullable();

            // Per-period override (month/term → amount)
            // Example:
            // { "01": 500, "02": 500, "03": 400 }
            $table->json('selected_periods')->nullable();

            // Reason for audit / reporting
            $table->string('reason')->nullable(); 
            // e.g. "Scholarship", "Staff Ward", "Special Case"

            $table->timestamps();

            // One override per student per fee head
            $table->unique(
                ['student_id', 'fee_structure_id'],
                'uniq_student_fee_override'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_structure_overrides');
    }
};
