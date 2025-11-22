<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_service', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id');
            $table->bigInteger('request_group_id');
            $table->dateTime('datetime');
            $table->date('date');
            $table->float('request_size');
            $table->string('request_size_unit', 255);
            $table->text('request_description');
            $table->string('requested_by_type', 255);
            $table->string('requested_by', 255);
            $table->text('requested_by_remark');
            $table->string('request_price', 255);
            $table->string('service_id', 255);
            $table->float('service_price');
            $table->text('service_done_by');
            $table->string('service_remark', 255);
            $table->float('gst');
            $table->string('hsn_code', 255);
            $table->bigInteger('cash_id');
            $table->tinyInteger('status')->unsigned();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_service');
    }
};

