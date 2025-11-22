<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_survey', function (Blueprint $table) {
            $table->unsignedBigInteger('id_primary', true); // ID Primary, auto-increment
            $table->bigInteger('survey_id');
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->string('session', 64);
            $table->string('month', 64);
            $table->string('category', 255)->nullable();
            $table->string('recipient', 64);
            $table->date('end_date');
            $table->longText('question')->nullable();
            $table->longText('option_1')->nullable();
            $table->longText('option_2')->nullable();
            $table->longText('option_3')->nullable();
            $table->longText('option_4')->nullable();
            $table->longText('remark')->nullable();
            $table->unsignedSmallInteger('option_1_responses')->nullable();
            $table->unsignedSmallInteger('option_2_responses')->nullable();
            $table->unsignedSmallInteger('option_3_responses')->nullable();
            $table->unsignedSmallInteger('option_4_responses')->nullable();
            $table->longText('responders')->nullable();
            $table->string('added_by_type', 64);
            $table->unsignedBigInteger('added_by');
            $table->string('status', 8);
            $table->bigInteger('client_id')->nullable();
            $table->unsignedBigInteger('added_by_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_survey');
    }
};

