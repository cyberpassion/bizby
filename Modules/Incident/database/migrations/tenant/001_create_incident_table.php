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
            $table->string('incident_code')->unique(); // INC-2026-xxxx

            $table->foreignId('center_id')->constrained()->cascadeOnDelete();

            $table->string('type'); // Fire, Rescue, Medical
            $table->text('location');
            $table->enum('severity', ['Low', 'Medium', 'High', 'Critical']);

            $table->date('incident_date');
            $table->time('incident_time');

            $table->string('reporter_name')->nullable();
			$table->string('reporter_contact', 20)->nullable();
			$table->text('actions_taken')->nullable();
			$table->text('resolution_notes')->nullable();
			$table->timestamp('resolved_at')->nullable();
			$table->timestamp('acknowledged_at')->nullable();
			$table->timestamp('closed_at')->nullable();
			//$table->boolean('is_escalated')->default(false);
			//$table->timestamp('escalated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
