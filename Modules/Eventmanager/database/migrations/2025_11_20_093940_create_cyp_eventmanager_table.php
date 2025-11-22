<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cyp_eventmanager', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id');
            $table->dateTime('datetime');
            $table->date('date');
            $table->date('event_start_date');
            $table->date('event_end_date')->nullable();
            $table->string('event_type', 255);
            $table->string('event_name', 255);
            $table->text('event_description');
            $table->text('participant');
            $table->text('event_participants');
            $table->text('event_remark');
            $table->integer('status');
            $table->string('created_by_type', 255)->nullable();
            $table->bigInteger('created_by_id')->nullable();
            $table->string('created_by', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cyp_eventmanager');
    }
};


