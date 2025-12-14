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

		    $table->foreignId('fee_frequency_id')->constrained('student_fee_frequencies')->cascadeOnDelete();
		    $table->foreignId('head_term_id')->constrained('terms')->cascadeOnDelete(); // fee_head

		    $table->json('selected_periods')->nullable();
		    $table->decimal('amount', 10, 2)->default(0);

		    $table->timestamps();

		    $table->unique(['fee_frequency_id', 'head_term_id']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_structures');
    }
};
