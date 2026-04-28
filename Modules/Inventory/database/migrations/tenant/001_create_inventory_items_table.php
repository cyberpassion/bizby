<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {

		    $table->commonSaasFields();

		    // Required relationship
		    $table->unsignedBigInteger('product_id');
		    $table->unsignedBigInteger('center_id')->nullable();

		    // Unique inventory code per tenant
		    $table->string('code');

		    // Stock rules
		    $table->decimal('minimum_threshold', 12, 2)->default(0);
		    $table->decimal('maximum_threshold', 12, 2)->nullable();

		    // Cached stock
		    $table->decimal('current_stock', 14, 2)->default(0);

		    // Constraints
		    $table->unique(['tenant_id', 'code']);
		    $table->unique(['tenant_id', 'product_id', 'center_id']);

		    // Foreign keys
		    //$table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
    		//$table->foreign('center_id')->references('id')->on('centers')->nullOnDelete();

		    // Indexes
    		$table->index(['product_id', 'center_id']);
		});
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
