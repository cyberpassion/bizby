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
        // Creating cyp_checklist table
        Schema::create('cyp_checklist', function (Blueprint $table) {

            $table->bigIncrements('id'); // Primary Key
            $table->unsignedBigInteger('client_id');
            $table->string('checklist_name', 255);
            $table->text('checklist_description');

            $table->unsignedBigInteger('listing_id');

            $table->string('is_sequence_to_follow', 64);

            $table->text('status_remark');

            $table->tinyInteger('status');

            $table->string('checklist_by', 255)->nullable();
            $table->string('checklist_by_type', 64)->nullable();
            $table->unsignedBigInteger('checklist_by_id')->nullable();

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        // Creating cyp_checklist_listing table
        Schema::create('cyp_checklist_listing', function (Blueprint $table) {

            $table->bigIncrements('id'); // PRIMARY KEY + AUTO_INCREMENT
            $table->unsignedBigInteger('client_id');
            $table->string('listing_type', 255);
            $table->string('listing_name', 255);
            $table->text('listing_description');

            $table->tinyInteger('status');

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        // Creating cyp_checklist_listing_point
            Schema::create('cyp_checklist_listing_point', function (Blueprint $table) {
            $table->bigIncrements('id'); // ID Primary (AUTO_INCREMENT)
            $table->unsignedBigInteger('client_id');
    
            $table->unsignedBigInteger('listing_id');
    
            $table->string('point_name', 255);
            $table->string('time_type', 64);
    
            $table->time('point_start_time');
            $table->time('point_end_time');
    
            $table->date('point_start_date');
            $table->date('point_end_date');
    
            $table->smallInteger('point_duration');
            $table->string('point_duration_type', 64);
    
            $table->unsignedBigInteger('point_position');
    
            $table->string('point_assigned_to', 255);
    
            $table->text('point_description');
    
            $table->tinyInteger('status');
    
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
    });
    // Creating cyp_checklist_point
    Schema::create('cyp_checklist_point', function (Blueprint $table) {
            $table->bigIncrements('id'); // ID Primary (AUTO_INCREMENT)
            $table->unsignedBigInteger('client_id');
    
            $table->unsignedBigInteger('checklist_id');
            $table->unsignedBigInteger('listing_id');
            $table->unsignedBigInteger('listing_point_id');
    
            $table->string('listing_point_assigned_to', 255);
    
            $table->text('checklist_description');
    
            $table->tinyInteger('listing_point_status');
    
            $table->unsignedBigInteger('thread_parent');
    
            $table->tinyInteger('status');
    
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist');
    }
};
