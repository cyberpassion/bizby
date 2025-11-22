<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_saleservice', function (Blueprint $table) {
			$table->id();
            $table->bigInteger('client_id');
            $table->unsignedBigInteger('saleservice_id')->nullable();
            $table->bigInteger('saleservice_group_id');
            $table->dateTime('datetime')->nullable();
            $table->date('date')->nullable();
            $table->string('category', 255);
            $table->date('saleservice_date');
            $table->string('session', 255);
            $table->string('month', 255);
            $table->bigInteger('buyer_id');
            $table->string('buyer_type', 255);
            $table->bigInteger('offering_id');
            $table->string('offering_type', 255);
            $table->float('offering_quantity');
            $table->string('offering_unit', 255);
            $table->float('offering_price')->unsigned();
            $table->float('gst_percentage');
            $table->text('remark');
            $table->string('system_remark', 255);
            $table->bigInteger('saleservice_by')->nullable();
            $table->date('next_date')->nullable();
            $table->string('offering_hsn_code', 255)->nullable();
            $table->float('discount_amount')->nullable();
            $table->float('taxable_price')->nullable();
            $table->float('igst')->nullable();
            $table->float('cgst')->nullable();
            $table->float('sgst')->nullable();
            $table->float('total_price');
            $table->string('invoice_type', 255)->nullable();
            $table->text('additional_saleinfo')->nullable();
            $table->date('due_date')->nullable();
            $table->string('invoice_prefix', 255)->nullable();
            $table->bigInteger('invoice_number')->nullable();
            $table->text('terms')->nullable();
            $table->bigInteger('thread_parent');
            $table->tinyInteger('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_saleservice');
    }
};