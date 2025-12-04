<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /** -----------------------------------------
         *  TABLE: cyp_checklist
         * ----------------------------------------- */
        Schema::create('checklists', function (Blueprint $table) {

            $table->commonSaasFields(); // id, client_id, status, timestamps, soft delete, created_by etc.

            $table->string('checklist_name', 255);
            $table->text('checklist_description');

            $table->unsignedBigInteger('listing_id');

            $table->string('is_sequence_to_follow', 64);

            $table->text('status_remark');

            $table->string('checklist_by', 255)->nullable();
            $table->string('checklist_by_type', 64)->nullable();
            $table->unsignedBigInteger('checklist_by_id')->nullable();
        });

        /** -----------------------------------------
         *  TABLE: cyp_checklist_listing
         * ----------------------------------------- */
        Schema::create('checklist_listings', function (Blueprint $table) {

            $table->commonSaasFields();

            $table->string('listing_type', 255);
            $table->string('listing_name', 255);
            $table->text('listing_description');
        });

        /** -----------------------------------------
         *  TABLE: cyp_checklist_listing_point
         * ----------------------------------------- */
        Schema::create('checklist_listing_points', function (Blueprint $table) {

            $table->commonSaasFields();

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
        });

        /** -----------------------------------------
         *  TABLE: cyp_checklist_point
         * ----------------------------------------- */
        Schema::create('checklist_points', function (Blueprint $table) {

            $table->commonSaasFields();

            $table->unsignedBigInteger('checklist_id');
            $table->unsignedBigInteger('listing_id');
            $table->unsignedBigInteger('listing_point_id');

            $table->string('listing_point_assigned_to', 255);

            $table->text('checklist_description');

            $table->tinyInteger('listing_point_status');

            $table->unsignedBigInteger('thread_parent');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checklist_points');
        Schema::dropIfExists('checklist_listing_points');
        Schema::dropIfExists('checklist_listings');
        Schema::dropIfExists('checklists');
    }
};
