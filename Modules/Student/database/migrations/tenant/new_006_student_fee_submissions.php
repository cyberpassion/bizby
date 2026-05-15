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

			$table->date('receipt_date');

			$table->decimal('gross_amount', 10, 2)->default(0);

			$table->decimal('discount_amount', 10, 2)->default(0);

			$table->decimal('fine_amount', 10, 2)->default(0);

			$table->decimal('paid_amount', 10, 2)->default(0);

			$table->decimal('balance_amount', 10, 2)->default(0);

		    $table->text('remarks')->nullable();

			$table->enum('fee_status', [
			    'completed',
			    'reversed',
			    'cancelled',
			])->default('completed');

			$table->enum('submission_status', [
			    'success',
			    'cancelled',
			    'refunded',
			    'failed'
			])->default('success');

			$table->timestamp('paid_at')
    			->nullable();

			$table->foreignId('submitted_by')
		        ->nullable();

			$table->timestamp('cancelled_at')
			    ->nullable();

			$table->foreignId('cancelled_by')
			    ->nullable()
			    ->nullOnDelete();

			$table->text('cancellation_reason')
			    ->nullable();

			$table->timestamp('reversed_at')
    			->nullable();

			$table->foreignId('reversed_by')
			    ->nullable();

			$table->text('reversal_reason')
			    ->nullable();

			$table->string('receipt_no')->unique();

			$table->enum('payment_mode', [
			    'cash',
			    'upi',
			    'online',
			    'bank_transfer',
			    'cheque'
			])->nullable();

			$table->string('transaction_reference')
				->nullable();

			$table->index([
			    'receipt_date'
			]);

			$table->index([
			    'student_id',
			    'year_id'
			]);

			$table->uuid('request_uuid')
			    ->nullable()
			    ->unique();

		});

    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_submissions');
    }
};
