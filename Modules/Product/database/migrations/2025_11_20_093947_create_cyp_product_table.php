<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_product', function (Blueprint $table) {
            $table->bigInteger('client_id');
            $table->bigIncrements('product_id');
            $table->dateTime('datetime')->nullable();
            $table->date('date')->nullable();
            $table->string('product_type', 255);
            $table->string('brand_name', 255);
            $table->string('product_name', 255);
            $table->float('retail_price')->unsigned();
            $table->text('product_description');
            $table->float('sale_price');
            $table->text('tags');
            $table->string('remark', 255);
            $table->string('unit', 255);
            $table->text('additional_features');
            $table->string('status', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_product');
    }
};

