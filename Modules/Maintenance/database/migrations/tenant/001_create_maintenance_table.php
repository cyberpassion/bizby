<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
           // Common SaaS fields (id, tenant_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();
            $table->foreignId('center_id')->constrained()->cascadeOnDelete();

            $table->string('asset'); // later replace with asset_id
            $table->string('issue_type');
            $table->text('description');

            $table->date('reported_date');

            $table->string('assigned_technician')->nullable();

            $table->decimal('cost', 10, 2)->nullable();

            $table->date('next_service_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
