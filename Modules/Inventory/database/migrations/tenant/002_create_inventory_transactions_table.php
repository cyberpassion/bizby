<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventory_transactions', function (Blueprint $table) {
		    // Common SaaS fields (id, tenant_id, status, timestamps, soft deletes, audit)
            $table->commonSaasFields();
    		$table->unsignedBigInteger('inventory_item_id')->index();

		    // Transaction Type
    		$table->enum('type', ['in', 'out', 'adjustment', 'transfer']);

		    // Quantity
    		$table->decimal('quantity', 14, 2);

		    // Before / After (for audit)
    		$table->decimal('stock_before', 14, 2);
		    $table->decimal('stock_after', 14, 2);

		    // Reference (VERY IMPORTANT)
		    $table->string('reference_type')->nullable(); 
    		// purchase, sale, manual, incident, etc.

		    $table->unsignedBigInteger('reference_id')->nullable();

		    // Location
    		$table->unsignedBigInteger('center_id')->nullable();
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
