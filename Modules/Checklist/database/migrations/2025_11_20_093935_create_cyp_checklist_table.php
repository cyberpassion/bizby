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
        Schema::create('cyp_checklist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->date('date');
            $table->dateTime('datetime');
            $table->string('checklist_by', 255);
            $table->string('checklist_by_type', 64);
            $table->unsignedBigInteger('checklist_by_id');
            $table->string('checklist_name', 255);
            $table->text('checklist_description');
            $table->unsignedBigInteger('listing_id');
            $table->string('is_sequence_to_follow', 64);
            $table->text('status_remark');
            $table->tinyInteger('status');
            $table->timestamps(); // optional: created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cyp_checklist');
    }
};

