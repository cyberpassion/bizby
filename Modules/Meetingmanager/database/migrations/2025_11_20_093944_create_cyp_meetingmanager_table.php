<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_meetingmanager', function (Blueprint $table) {
            $table->bigInteger('client_id');
            $table->bigIncrements('meeting_id');
            $table->unsignedBigInteger('meeting_group_id');
            $table->date('date');
            $table->dateTime('datetime');
            $table->string('meeting_type', 255);
            $table->date('meeting_date');
            $table->time('meeting_time');
            $table->string('requested_by_name', 255);
            $table->string('father_name', 255);
            $table->string('phone_number', 255);
            $table->string('email_id', 255);
            $table->string('permanent_address', 255);
            $table->string('meeting_with_type', 255);
            $table->tinyInteger('meeting_with_id');
            $table->text('meeting_with');
            $table->date('meeting_exit_date');
            $table->time('meeting_exit_time');
            $table->text('meeting_exit_remark');
            $table->tinyInteger('priority');
            $table->text('reason');
            $table->text('reference');
            $table->text('remark');
            $table->unsignedTinyInteger('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_meetingmanager');
    }
};
