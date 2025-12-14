<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fee_frequencies', function (Blueprint $table) {
		    $table->id();
			$table->foreignId('year_id')->constrained('student_academic_years')->cascadeOnDelete();
    		$table->foreignId('class_term_id')->constrained('terms')->cascadeOnDelete();
		    $table->foreignId('section_term_id')->constrained('terms')->cascadeOnDelete();
    
		    $table->enum('frequency', ['monthly', 'quarterly', 'semester', 'yearly']);
		    $table->json('selected_periods')->nullable(); // e.g., ["Jan", "Feb", "Mar"]
    
		    $table->timestamps();
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_frequencies');
    }
};
