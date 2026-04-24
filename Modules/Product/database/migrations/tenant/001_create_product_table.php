<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            // SaaS Common Fields
            $table->commonSaasFields();

            // Product Info
            $table->string('product_type'); // physical | service
            $table->string('brand')->nullable();
            $table->string('name');

            // Unique identity
            $table->string('sku')->nullable();

            // Pricing (use decimal)
            $table->decimal('retail_price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();

            // Details
            $table->text('product_description')->nullable();
            $table->text('additional_features')->nullable();

            // Optional
            $table->string('unit')->nullable(); // kg, pcs, liter
            $table->string('availability')->nullable(); // optional (UI use)

            // Constraints
            $table->unique(['tenant_id', 'sku']);
            $table->index(['product_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};