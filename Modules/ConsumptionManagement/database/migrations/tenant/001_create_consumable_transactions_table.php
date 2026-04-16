<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('consumable_transactions', function (Blueprint $table) {
            // Common SaaS fields (id, tenant_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();

            $table->foreignId('center_id')->constrained()->cascadeOnDelete();

            $table->enum('mode', ['refill', 'consumption']);

            $table->string('type'); // Diesel, Foam etc.
            $table->decimal('quantity', 10, 2);

            $table->dateTime('entry_datetime');

            $table->string('user'); // later user_id

            $table->string('vehicle')->nullable();
            $table->string('incident_id')->nullable();

            $table->string('supplier')->nullable();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consumable_transactions');
    }
};