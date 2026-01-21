<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Creating cyp_communication table
        Schema::create('communications', function (Blueprint $table) {

            $table->bigIncrements('message_id'); // PRIMARY KEY + AUTO_INCREMENT

            // Communication Reference
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->string('request_id', 255);

            // Message Content
            $table->longText('message')->nullable();

            // Recipient Details
            $table->string('recipient_type', 255)->nullable();
            $table->unsignedBigInteger('recipient_id');
            $table->text('sent_to');

            // Communication Mode
            $table->string('mode', 255)->nullable();
            $table->string('service_name', 255);

            // Status
            $table->tinyInteger('status');

            // Client / Session Info
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->string('session', 64)->nullable();

            // Timestamps
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('communications');
    }
};



