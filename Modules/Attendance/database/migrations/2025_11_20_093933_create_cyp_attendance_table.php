<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_attendances', function (Blueprint $table) {
            $table->bigIncrements('attendance_id'); // Primary key with auto-increment
            $table->bigInteger('client_id');
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->string('session', 255);
            $table->string('month', 255);
            $table->date('absent_date')->nullable();
            $table->string('absent_date_part', 255);
            $table->float('absent_duration');
            $table->string('absentee_type', 255)->nullable();
            $table->string('absentee_id', 255);
            $table->string('absent_code', 255)->nullable();
            $table->string('absent_reason', 255)->nullable();
            $table->boolean('is_paid');
            $table->mediumText('remark')->nullable();
            $table->tinyInteger('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_attendances');
    }
};
