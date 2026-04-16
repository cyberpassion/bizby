<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
		   // Common SaaS fields (id, tenant_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();

		    // Link to product (optional but recommended)
		    $table->unsignedBigInteger('product_id')->nullable()->index();

		    // Basic Info
		    $table->string('name');
		    $table->string('code')->unique(); // INV-001
    		$table->string('unit'); // Liters, Units, etc.

		    // Stock Rules
		    $table->decimal('minimum_threshold', 12, 2)->default(0);
		    $table->decimal('maximum_threshold', 12, 2)->nullable();

		    // Current Stock (cached, NOT source of truth)
		    $table->decimal('current_stock', 14, 2)->default(0);

		    // Location
		    $table->unsignedBigInteger('center_id')->nullable()->index();

		    // Status
    		// $table->enum('status', ['active', 'inactive'])->default('active');
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
