<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_meetingmanager', function (Blueprint $table) {
            // Common SaaS fields
            $table->commonSaasFields();

            // Meeting-specific fields
            $table->unsignedBigInteger('meeting_group_id');
            $table->string('meeting_type', 255);
            $table->date('meeting_date');
            $table->time('meeting_time');
            $table->string('requested_by_name', 255);
            $table->string('father_name', 255);
            $table->string('phone_number', 255);
            $table->string('email');
            $table->text('address');
            $table->string('meeting_with_type', 255);
            $table->unsignedBigInteger('meeting_with_id');
            $table->text('meeting_with');
            $table->date('meeting_exit_date')->nullable();
            $table->time('meeting_exit_time')->nullable();
            $table->text('meeting_exit_remark')->nullable();
            $table->tinyInteger('priority')->default(0);
            $table->text('reason')->nullable();
            $table->text('reference')->nullable();
            $table->text('remark')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_meetingmanager');
    }
};

