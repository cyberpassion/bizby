<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {

            // SaaS Common Fields
            $table->commonSaasFields();

            // Group Info
            $table->unsignedBigInteger('request_group_id');

            // Request Details
            $table->float('request_size');
            $table->string('request_size_unit', 255);
            $table->text('request_description')->nullable();

            // Requester Info
            $table->string('requested_by_type', 255)->nullable();
            $table->string('requested_by', 255)->nullable();
            $table->text('requested_by_remark')->nullable();

            // Service Details
            $table->string('request_price', 255)->nullable();
            $table->string('service_id', 255)->nullable();
            $table->float('service_price')->nullable();
            $table->text('service_done_by')->nullable();
            $table->string('service_remark', 255)->nullable();

            // Tax & Cash Info
            $table->float('gst')->nullable();
            $table->string('hsn_code', 255)->nullable();
            $table->unsignedBigInteger('cash_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};


