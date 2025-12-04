<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_fee_transaction_items', function (Blueprint $table) {
		    $table->id();

		    $table->foreignId('transaction_id')
        		->constrained('student_fee_transactions')
        		->onDelete('cascade');

		    $table->foreignId('student_fee_id')
		        ->constrained('student_fees')
        		->onDelete('cascade');

		    $table->decimal('amount_paid', 10, 2);

		    $table->timestamps();
		});

    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_transaction_items');
    }
};
