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
            // Common SaaS fields
            $table->commonSaasFields();
            
            // Polymorphic user reference
            $table->string('checklist_by_type', 64)->nullable();
            $table->unsignedBigInteger('checklist_by_id')->nullable();

            $table->string('checklist_name', 255);
            $table->text('checklist_description')->nullable();
            $table->unsignedBigInteger('listing_id');
            $table->string('is_sequence_to_follow', 64)->nullable();
            $table->text('status_remark')->nullable();
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


