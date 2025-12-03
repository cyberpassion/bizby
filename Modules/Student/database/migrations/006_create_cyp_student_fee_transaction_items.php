<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cyp_student_fee_transaction_item', function (Blueprint $table) {

			// Common SaaS Fields
            $table->commonSaasFields();
            // id, client_id, status, created_by, updated_by, deleted_by, deleted_at, timestamps

            $table->foreignId('transaction_id')->constrained('cyp_student_fee_transaction')->onDelete('cascade');
            $table->foreignId('student_fee_id')->constrained('cyp_student_fee')->onDelete('cascade');

            $table->decimal('amount_paid', 10, 2);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_transaction_items');
    }
};
