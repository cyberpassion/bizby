<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventmanagers', function (Blueprint $table) {

            // Common SaaS fields (id, client_id, status, audit, soft deletes, timestamps)
            $table->commonSaasFields();

            // Event-specific fields
            $table->date('event_start_date');
            $table->date('event_end_date')->nullable();

            $table->string('event_type', 255);
            $table->string('event_name', 255);
            $table->text('event_description');
            $table->text('participant');
            $table->text('event_participants');
            $table->text('event_remark');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventmanagers');
    }
};


