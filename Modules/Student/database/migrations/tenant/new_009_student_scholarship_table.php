<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_scholarships', function (Blueprint $table) {

            $table->id();

            $table->commonSaasFields();

            /* =====================================================
            | RELATIONS
            ===================================================== */

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('year_id')
                ->nullable()
                ->constrained('academic_years')
                ->nullOnDelete();

            /* =====================================================
            | SCHOLARSHIP INFO
            ===================================================== */

            $table->string('name');
            // Merit Scholarship
            // Sports Scholarship
            // Government Scholarship

            $table->string('code')->nullable();

            $table->string('provider')->nullable();
            // Govt / NGO / School / Trust

            $table->string('category')->nullable();
            // Merit / Sports / Need Based / Minority

            /* =====================================================
            | FINANCIAL
            ===================================================== */

            $table->decimal('amount', 12, 2)
                ->nullable();

            $table->decimal('percentage', 5, 2)
                ->nullable();

            $table->boolean('is_full_scholarship')
                ->default(false);

            /* =====================================================
            | DURATION
            ===================================================== */

            $table->date('start_date')
                ->nullable();

            $table->date('end_date')
                ->nullable();

            $table->boolean('is_lifetime')
                ->default(false);

            /* =====================================================
            | STATUS
            ===================================================== */

            $table->string('approval_status')
                ->default('pending');
            // pending / approved / rejected

            $table->date('approved_at')
                ->nullable();

            $table->foreignId('approved_by')
                ->nullable();

            /* =====================================================
            | ELIGIBILITY / REMARKS
            ===================================================== */

            $table->text('reason')
                ->nullable();

            $table->text('remarks')
                ->nullable();

            $table->text('terms_conditions')
                ->nullable();

            /* =====================================================
            | DOCUMENTS
            ===================================================== */

            $table->string('document')
                ->nullable();

            $table->string('certificate')
                ->nullable();

            /* =====================================================
            | EXTRA
            ===================================================== */

            $table->json('meta')
                ->nullable();

            /* =====================================================
            | INDEXES
            ===================================================== */

            $table->index(['student_id']);

            $table->index(['year_id']);

            $table->index(['approval_status']);

            $table->index(['category']);

            $table->index(['provider']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_scholarships');
    }
};