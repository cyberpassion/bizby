<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('incident_closures', function (Blueprint $table) {
            // Common SaaS fields
            $table->commonSaasFields();

            // One closure per incident
            $table->foreignId('incident_id')
                  ->unique()
                  ->constrained()
                  ->cascadeOnDelete();

            // Structured closure report
            $table->text('resolution_summary');
            $table->text('root_cause')->nullable();
            $table->text('preventive_measures')->nullable();

            $table->unsignedBigInteger('closed_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incident_closures');
    }
};