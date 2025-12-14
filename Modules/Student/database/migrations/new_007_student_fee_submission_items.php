<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fee_submission_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('fee_submission_id')->constrained('student_fee_submissions')->cascadeOnDelete();
            $table->foreignId('fee_structure_id')->constrained('student_fee_structures')->cascadeOnDelete();
            
            $table->decimal('payable_amount', 10, 2)->default(0); // amount set to pay for this fee head
            $table->decimal('discount_applied', 10, 2)->default(0); // discount applied for this head
            $table->decimal('paid_amount', 10, 2)->default(0); // final paid amount

            $table->json('selected_periods')->nullable(); // months/quarters/semesters actually paid

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_submission_items');
    }
};
