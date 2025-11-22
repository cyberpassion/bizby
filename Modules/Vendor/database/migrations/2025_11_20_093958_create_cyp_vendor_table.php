<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_vendor', function (Blueprint $table) {
            $table->bigIncrements('vendor_id'); // Primary Key, auto-increment
            $table->bigInteger('client_id');
            $table->unsignedBigInteger('vendor_parent_id')->nullable();
            $table->text('vendor_official_name');
            $table->string('vendor_official_phone', 255);
            $table->string('vendor_official_email', 255);
            $table->text('vendor_official_address');
            $table->string('vendor_gstin', 255);
            $table->string('vendor_pan', 255);
            $table->text('vendor_info')->nullable();
            $table->text('vendor_bank_info')->nullable();
            $table->text('vendor_terms_and_condition')->nullable();
            $table->text('region')->nullable();
            $table->text('vendor_person')->nullable();
            $table->text('vendor_person_designation')->nullable();
            $table->text('vendor_person_phone')->nullable();
            $table->text('vendor_person_email')->nullable();
            $table->string('state', 64)->nullable();
            $table->string('district', 255)->nullable();
            $table->text('sales')->nullable();
            $table->bigInteger('thread_parent')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->string('vendor_type', 64)->nullable();
            $table->string('vendor_code', 255)->nullable();
            $table->float('incentive_percentage')->nullable();

            // Optional timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_vendor');
    }
};


