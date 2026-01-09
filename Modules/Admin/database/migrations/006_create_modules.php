<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();

            // Identity
            $table->string('key')->unique();
            // Example: student, library, transport

            $table->string('name');
            // Human-readable name: "Student Management"

            $table->text('description')->nullable();
            // What this module does (shown in UI)

            // Pricing (base yearly price)
            $table->decimal('price', 10, 2)->nullable();
            // Base price used when assigning module to tenant
            // Snapshot is stored in tenant_modules

            // Billing behavior
            $table->boolean('is_billable')->default(true);
            // If false, module is free (no billing)

            $table->boolean('is_core')->default(false);
            // Core modules cannot be removed from tenants

            // Availability
            $table->boolean('is_active')->default(true);
            // If false, module cannot be newly assigned

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
