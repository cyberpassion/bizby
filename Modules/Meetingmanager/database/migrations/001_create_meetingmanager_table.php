<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meetingmanagers', function (Blueprint $table) {

            // SaaS Defaults (client_id, status, created_by, updated_by, deleted_by, timestamps, softDeletes)
            $table->commonSaasFields();

            // Core Fields
            $table->unsignedBigInteger('meeting_group_id')->nullable();

            $table->string('meeting_type')->nullable();

            $table->date('meeting_date')->nullable();
            $table->time('meeting_time')->nullable();

            // Requestor Details
            $table->string('requested_by_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('email', 255)->nullable();

            $table->string('permanent_address')->nullable();

            // Meeting With
            $table->string('meeting_with_type')->nullable();
            $table->text('meeting_with')->nullable();
            $table->unsignedBigInteger('meeting_with_id')->nullable();

            // Meeting Details
            $table->unsignedTinyInteger('priority')->default(1);
            $table->text('reason')->nullable();
            $table->text('reference')->nullable();

            // Exit Details (First Exit)
            $table->date('exit_date')->nullable();
            $table->time('exit_time')->nullable();
            $table->text('exit_remark')->nullable();

            // Meeting Exit Details
            $table->date('meeting_exit_date')->nullable();
            $table->time('meeting_exit_time')->nullable();
            $table->text('meeting_exit_remark')->nullable();

            // Extra fields
            $table->string('email_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meetingmanagers');
    }
};


