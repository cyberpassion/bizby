<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_communication', function (Blueprint $table) {
            // Common SaaS fields
            $table->commonSaasFields();

            // Communication-specific fields
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->string('request_id', 255);
            $table->longText('message')->nullable();

            // Polymorphic recipient
            $table->string('recipient_type', 255)->nullable();
            $table->unsignedBigInteger('recipient_id')->nullable();
            
            $table->text('sent_to')->nullable();
            $table->string('mode', 255)->nullable();
            $table->string('service_name', 255);
            $table->string('session', 64)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_communication');
    }
};
