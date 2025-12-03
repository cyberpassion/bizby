<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cyp_student_fee', function (Blueprint $table) {

			// Common SaaS Fields
            $table->commonSaasFields();
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

            $table->foreignId('student_id')->constrained('cyp_student')->onDelete('cascade');
            $table->foreignId('fee_head_id')->constrained('cyp_student_fee_head')->onDelete('cascade');
            $table->foreignId('class_id')->nullable()->onDelete('set null');

            $table->string('academic_year'); // 2025-26
            $table->string('month'); // April, May, etc.

            $table->decimal('payable', 10, 2)->default(0);
            $table->decimal('concession', 10, 2)->default(0);

            $table->boolean('is_active')->default(true);
            $table->string('cancel_reason')->nullable();
            $table->timestamp('cancelled_at')->nullable();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_student_fee');
    }
};
