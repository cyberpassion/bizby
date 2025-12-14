<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fee_submissions', function (Blueprint $table) {
		    $table->id();

		    $table->foreignId('student_id')->constrained()->cascadeOnDelete();
			$table->foreignId('year_id')->constrained('student_academic_years')->cascadeOnDelete();
		    $table->foreignId('class_term_id')->constrained('terms');
    		$table->foreignId('section_term_id')->constrained('terms');

		    $table->decimal('total_amount', 10, 2)->default(0);
		    $table->decimal('total_discount', 10, 2)->default(0);
    		$table->decimal('amount_received', 10, 2)->default(0);

		    $table->text('remarks')->nullable();
    		$table->timestamps();
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_submissions');
    }
};
