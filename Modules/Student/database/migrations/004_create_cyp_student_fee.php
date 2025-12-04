<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cyp_student_fee', function (Blueprint $table) {
		    $table->id();

		    $table->foreignId('student_id')->constrained('cyp_student')->onDelete('cascade');
		    $table->foreignId('fee_head_id')->constrained('cyp_fee_head')->onDelete('cascade');
    		$table->foreignId('class_id')->nullable()->constrained()->onDelete('set null');

		    $table->string('academic_year');  // 2025–26

		    // Frequency-agnostic period identification
		    $table->string('period_code');     // '2025-04', '2025-Q1', '2025', '2025-APR-JUN'
    		$table->string('period_label');    // 'April 2025', 'Q1 2025', 'Annual 2025-26'

		    $table->decimal('payable', 10, 2)->default(0);
		    $table->decimal('concession', 10, 2)->default(0);

		    $table->boolean('is_active')->default(true);
		    $table->timestamp('cancelled_at')->nullable();
    		$table->string('cancel_reason')->nullable();

		    $table->timestamps();
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_student_fee');
    }
};
