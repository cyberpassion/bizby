<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_cash_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reference_id')->unsigned();   // e.g., student or user id
            $table->string('reference_type')->default('general'); // optional type
            $table->decimal('amount', 12, 2);
            $table->string('status')->default('pending'); // pending, completed, etc.
            $table->string('received_by')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_cash_transactions');
    }
};
