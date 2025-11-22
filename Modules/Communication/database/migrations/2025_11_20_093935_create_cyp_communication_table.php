<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_communication', function (Blueprint $table) {
            $table->unsignedBigInteger('message_id', true); // Primary Key, auto-increment
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->string('request_id', 255);
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->longText('message')->nullable();
            $table->string('recipient_type', 255)->nullable();
            $table->unsignedBigInteger('recipient_id');
            $table->text('sent_to');
            $table->string('mode', 255)->nullable();
            $table->string('service_name', 255);
            $table->tinyInteger('status');
            $table->bigInteger('client_id')->nullable();
            $table->string('session', 64)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_communication');
    }
};

