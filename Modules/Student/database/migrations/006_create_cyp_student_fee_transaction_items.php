<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cyp_student_fee_transaction_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('cyp_student_fee_transaction')->onDelete('cascade');
            $table->foreignId('student_fee_id')->constrained('cyp_student_fee')->onDelete('cascade');

            $table->decimal('amount_paid', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_transaction_items');
    }
};
