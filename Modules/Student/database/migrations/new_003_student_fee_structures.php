<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fee_structures', function (Blueprint $table) {
		    $table->id();

		    // Context
		    $table->foreignId('year_id')
        		->constrained('student_academic_years')
        		->cascadeOnDelete();

		    $table->foreignId('class_term_id')
		        ->constrained('terms')
        		->cascadeOnDelete();

		    $table->foreignId('section_term_id')
        		->constrained('terms')
		        ->cascadeOnDelete();

		    // Fee head
		    $table->foreignId('head_term_id')
        		->constrained('terms')
        		->cascadeOnDelete();

		    // Frequency config
		    $table->enum('frequency', [
        		'monthly',
		        'quarterly',
        		'semester',
        		'yearly'
    		]);

			// Amount
		    $table->decimal('amount', 10, 2)->default(0);

		    // Period selection (months / terms)
		    $table->json('selected_periods')->nullable();

		    $table->timestamps();

		    // Business-level uniqueness
		    $table->unique([
        		'year_id',
		        'class_term_id',
        		'section_term_id',
		        'head_term_id'
    		], 'uniq_fee_structure');
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_structures');
    }
};
