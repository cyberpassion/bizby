<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_transport', function (Blueprint $table) {
            $table->bigIncrements('transport_vehicle_id'); // Primary Key, auto-increment
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
            $table->longText('remark')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->bigInteger('client_id')->nullable();
            
            // Optional timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_transport');
    }
};

