<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_vendor', function (Blueprint $table) {
            $table->bigInteger('client_id');
            $table->unsignedBigIncrements('vendor_id'); // Primary Key, auto-increment
            $table->date('date');
            $table->dateTime('datetime');
            $table->unsignedBigInteger('vendor_parent_id');
            $table->text('vendor_official_name');
            $table->string('vendor_official_phone', 255);
            $table->string('vendor_official_email', 255);
            $table->text('vendor_official_address');
            $table->string('vendor_gstin', 255);
            $table->string('vendor_pan', 255);
            $table->text('vendor_info');
            $table->text('vendor_bank_info');
            $table->text('vendor_terms_and_condition');
            $table->text('region');
            $table->text('vendor_person');
            $table->text('vendor_person_designation');
            $table->text('vendor_person_phone');
            $table->text('vendor_person_email');
            $table->string('state', 64);
            $table->string('district', 255);
            $table->text('sales');
            $table->bigInteger('thread_parent');
            $table->unsignedTinyInteger('status');
            $table->string('vendor_type', 64)->nullable();
            $table->string('vendor_code', 255)->nullable();
            $table->float('incentive_percentage')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_vendor');
    }
};

