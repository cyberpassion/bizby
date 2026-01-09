<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fee_discounts', function (Blueprint $table) {
            $table->id();

            // Optional: link to student if discount is individual
            $table->foreignId('student_id')->nullable()->constrained()->cascadeOnDelete();

            // Optional: link to fee structure (specific fee head + periods)
            $table->foreignId('student_fee_structure_id')->nullable()->constrained('student_fee_structures')->cascadeOnDelete();

			$table->foreignId('year_id')->constrained('student_academic_years')->cascadeOnDelete();

            $table->string('name'); // discount label, e.g., "Sibling Discount", "Merit Scholarship"
            $table->decimal('amount', 10, 2)->nullable(); // fixed amount
            $table->decimal('percentage', 5, 2)->nullable(); // percentage discount

            $table->json('applicable_periods')->nullable(); // override periods if discount only for specific months/semesters

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_discounts');
    }
};
