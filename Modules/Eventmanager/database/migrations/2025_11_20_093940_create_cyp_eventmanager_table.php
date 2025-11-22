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
            // Common SaaS fields
            $table->commonSaasFields();

            // Event-specific fields
            $table->date('event_start_date');
            $table->date('event_end_date')->nullable();
            $table->string('event_type', 255);
            $table->string('event_name', 255);
            $table->text('event_description')->nullable();
            $table->text('participant')->nullable();
            $table->text('event_participants')->nullable();
            $table->text('event_remark')->nullable();

            // Polymorphic creator reference
            $table->string('created_by_type', 255)->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
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



