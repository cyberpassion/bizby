<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_product', function (Blueprint $table) {
            // Common SaaS fields: id, client_id, status, timestamps, soft deletes, audit
            $table->commonSaasFields();

            // Product-specific fields
            $table->string('product_type', 255);
            $table->string('brand_name', 255)->nullable();
            $table->string('product_name', 255);
            $table->float('retail_price')->unsigned()->nullable();
            $table->float('sale_price')->nullable();
            $table->text('product_description')->nullable();
            $table->text('tags')->nullable();
            $table->string('unit', 255)->nullable();
            $table->text('additional_features')->nullable();
            $table->string('remark', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_product');
    }
};


