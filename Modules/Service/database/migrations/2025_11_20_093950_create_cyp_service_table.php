<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_service', function (Blueprint $table) {
            // Common SaaS fields: id, client_id, status, timestamps, soft deletes, audit
            $table->commonSaasFields();

            // Service-specific fields
            $table->bigInteger('request_group_id');
            $table->float('request_size')->nullable();
            $table->string('request_size_unit', 255)->nullable();
            $table->text('request_description')->nullable();
            $table->string('requested_by_type', 255)->nullable();
            $table->string('requested_by', 255)->nullable();
            $table->text('requested_by_remark')->nullable();
            $table->string('request_price', 255)->nullable();
            $table->string('service_id', 255)->nullable();
            $table->float('service_price')->nullable();
            $table->text('service_done_by')->nullable();
            $table->string('service_remark', 255)->nullable();
            $table->float('gst')->nullable();
            $table->string('hsn_code', 255)->nullable();
            $table->bigInteger('cash_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_service');
    }
};


