<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cyp_student_fee_payment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');

            $table->decimal('amount', 10, 2);
            $table->string('payment_mode')->nullable(); // cash, online, cheque
            $table->string('reference')->nullable();   // UPI ID, txn id, cheque number

            $table->date('date')->default(now());

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_student_fee_payment');
    }
};
