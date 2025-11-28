<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_survey', function (Blueprint $table) {

            // Primary Key
            $table->id('ID');

            // SaaS Common Fields
            $table->commonSaasFields();

            // Survey Details
            $table->unsignedBigInteger('survey_id');
            $table->string('session', 64)->nullable();
            $table->string('month', 64)->nullable();
            $table->string('category', 255)->nullable();
            $table->string('recipient', 64)->nullable();
            $table->date('end_date')->nullable();

            // Questions & Options
            $table->longText('question')->nullable();
            $table->longText('option_1')->nullable();
            $table->longText('option_2')->nullable();
            $table->longText('option_3')->nullable();
            $table->longText('option_4')->nullable();

            $table->unsignedSmallInteger('option_1_responses')->nullable();
            $table->unsignedSmallInteger('option_2_responses')->nullable();
            $table->unsignedSmallInteger('option_3_responses')->nullable();
            $table->unsignedSmallInteger('option_4_responses')->nullable();

            $table->longText('responders')->nullable();
            $table->longText('remark')->nullable();

            // Added by info
            $table->string('added_by_type', 64)->nullable();
            $table->unsignedBigInteger('added_by_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_survey');
    }
};



