<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('incident_logs', function (Blueprint $table) {
            // Common SaaS fields
            $table->commonSaasFields();

            $table->foreignId('incident_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('event'); // controlled via constants in code
            $table->text('notes')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();

            // Indexes
            $table->index('incident_id');
            $table->index('event');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incident_logs');
    }
};