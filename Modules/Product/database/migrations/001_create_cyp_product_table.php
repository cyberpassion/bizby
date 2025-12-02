<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_product', function (Blueprint $table) {

            // SaaS Common Fields
            $table->commonSaasFields();

            // Product Info
            $table->string('product_type', 255);
            $table->string('brand_name', 255);
            $table->string('product_name', 255);

            $table->float('retail_price')->unsigned();
            $table->float('sale_price');

            $table->text('product_description')->nullable();
            $table->text('tags')->nullable();
            $table->text('additional_features')->nullable();

            // Stock
            $table->unsignedBigInteger('total_quantity')->nullable();
            $table->unsignedBigInteger('available_stock')->nullable();
            $table->unsignedBigInteger('sold_quantity')->nullable();

            // Other Info
            $table->string('unit', 255)->nullable();
            $table->string('availability', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_product');
    }
};


