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
        Schema::create('cyp_registration', function (Blueprint $table) {
            $table->bigInteger('client_id');
            $table->bigIncrements('registration_id');
            $table->date('date');
            $table->dateTime('datetime');
            $table->string('registration_type', 255);
            $table->string('session', 64);
            $table->text('name');
            $table->text('phone_number');
            $table->text('email_id');
            $table->text('permanent_address');
            $table->text('remark');
            $table->text('metainfo');
            $table->tinyInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cyp_registration');
    }
};
