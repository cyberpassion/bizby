<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_announcement', function (Blueprint $table) {
            $table->bigIncrements('ID'); // Primary key with auto-increment
            $table->bigInteger('client_id');
            $table->bigInteger('announcement_id');
            $table->date('date')->nullable();
            $table->string('session', 255);
            $table->string('month', 255);
            $table->date('end_date')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->string('category', 255)->nullable();
            $table->string('recipient', 255);
            $table->longText('announcement')->nullable();
            $table->string('added_by_type', 255)->nullable();
            $table->unsignedBigInteger('added_by_id')->nullable();
            $table->string('added_by', 255);
            $table->tinyInteger('status')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_announcement');
    }
};
