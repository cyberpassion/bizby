<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('consumable_stocks', function (Blueprint $table) {
            // Common SaaS fields (id, tenant_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();

            $table->foreignId('center_id')->constrained()->cascadeOnDelete();

            $table->string('type'); // Diesel, Petrol, etc.
            $table->decimal('quantity', 10, 2)->default(0);
            $table->string('unit')->default('L');

            $table->decimal('low_threshold', 10, 2)->nullable();

            $table->unique(['center_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consumable_stocks');
    }
};