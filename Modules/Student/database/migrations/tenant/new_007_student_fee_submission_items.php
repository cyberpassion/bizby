<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fee_submission_items', function (Blueprint $table) {
            // Common SaaS Fields
            $table->commonSaasFields();
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

			$table->foreignId('submission_id')
			    ->constrained('student_fee_submissions')
			    ->cascadeOnDelete();

            $table->foreignId('due_id')
        		->constrained('student_fee_dues');
            
			$table->decimal('gross_amount', 10, 2)->default(0);

			$table->decimal('discount_amount', 10, 2)->default(0);

			$table->decimal('fine_amount', 10, 2)->default(0);

			$table->decimal('paid_amount', 10, 2)->default(0);

			$table->decimal('balance_amount', 10, 2)->default(0);

			$table->index([
			    'submission_id'
			]);

			$table->index([
			    'due_id'
			]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_submission_items');
    }
};
