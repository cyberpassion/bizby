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
        Schema::create('cyp_signup', function (Blueprint $table) {
            $table->bigInteger('client_id');
            $table->increments('signup_id');
            $table->date('date');
            $table->dateTime('datetime');
            $table->bigInteger('form_id');
            $table->string('form_label', 255);
            $table->string('signup_label', 255);
            $table->string('submitted_by_type', 255);
            $table->bigInteger('submitted_by_id');
            $table->text('name');
            $table->string('email');
            $table->string('phone_number', 255);
            $table->text('signup_info');
            $table->string('signup_fee', 255);
            $table->string('entry_source', 255);
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cyp_signup');
    }
};

