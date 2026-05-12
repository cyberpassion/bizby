<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fee_submissions', function (Blueprint $table) {
		    // Common SaaS Fields
            $table->commonSaasFields();
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

		    $table->foreignId('student_id')->constrained()->cascadeOnDelete();
			$table->foreignId('year_id')->constrained('student_academic_years')->cascadeOnDelete();
		    $table->foreignId('class_term_id')->constrained('terms');
    		$table->foreignId('section_term_id')->constrained('terms');

		    $table->decimal('total_amount', 10, 2)->default(0);
		    $table->decimal('total_discount', 10, 2)->default(0);
    		$table->decimal('amount_received', 10, 2)->default(0);

		    $table->text('remarks')->nullable();

			$table->enum('fee_status', [
			    'completed',
			    'reversed',
			    'cancelled',
			])->default('completed');

			$table->timestamp('paid_at')
    			->nullable();

			$table->timestamp('reversed_at')
    			->nullable();

			$table->foreignId('reversed_by')
			    ->nullable();

			$table->text('reversal_reason')
			    ->nullable();
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_submissions');
    }
};
