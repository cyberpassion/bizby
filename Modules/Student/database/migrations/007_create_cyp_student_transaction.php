<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_fee_transactions', function (Blueprint $table) {
		    $table->id();

		    $table->foreignId('student_id')->constrained('students')->onDelete('cascade');

		    $table->decimal('amount', 10, 2);
		    $table->string('payment_mode')->nullable(); // cash, cheque, online
		    $table->string('reference')->nullable();   // UPI/transaction/cheque no.

		    $table->date('date')->default(now());
    		$table->timestamps();
			$table->index(['student_id']);
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_transactions');
    }
};
