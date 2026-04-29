<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('incidents', function (Blueprint $table) {
            // Common SaaS fields (id, tenant_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();

            // Unique per tenant
            $table->string('incident_code');
            $table->unique(['tenant_id', 'incident_code']);

            $table->foreignId('center_id')->constrained()->cascadeOnDelete();

            $table->string('type'); // Fire, Rescue, Medical
            $table->text('location');
            $table->enum('severity', ['Low', 'Medium', 'High', 'Critical']);

            $table->date('incident_date');
            $table->time('incident_time');

            $table->string('reporter_name')->nullable();
            $table->string('reporter_contact', 20)->nullable();

            // Lifecycle timestamps (current state snapshot)
            $table->timestamp('acknowledged_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamp('closed_at')->nullable();

            // Indexes for performance
            $table->index(['tenant_id', 'status']);
            $table->index('center_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
