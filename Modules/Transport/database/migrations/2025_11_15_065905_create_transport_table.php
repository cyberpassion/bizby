<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_transport', function (Blueprint $table) {

            // Common SaaS fields (client_id, status, audit, softDeletes, timestamps)
            $table->commonSaasFields();

            // Transport Details
            $table->string('route_name', 255)->nullable();
            $table->string('registration_number', 255)->nullable();
            $table->string('vehicle_type', 255)->nullable();
            $table->tinyInteger('seating_capacity')->nullable();
            $table->date('insurance_renewal_date')->nullable();
            $table->string('driver_name', 255)->nullable();
            $table->string('driver_phone_number', 255)->nullable();
            $table->longText('route')->nullable();
            $table->time('to_start')->nullable();
            $table->time('to_end')->nullable();
            $table->time('fro_start')->nullable();
            $table->time('fro_end')->nullable();

            // Optional: thread_parent / hierarchical tracking
            $table->unsignedBigInteger('thread_parent')->nullable();
            $table->longText('additional_info')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_transport');
    }
};


