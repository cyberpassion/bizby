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
        Schema::create('cyp_examresult', function (Blueprint $table) {
            $table->bigIncrements('exam_id');
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->string('exam_session', 255);
            $table->string('exam_name', 255)->nullable();
            $table->string('exam_class', 255)->nullable();
            $table->string('exam_section', 255)->nullable();
            $table->string('exam_type', 255)->nullable();
            $table->string('examinee_id_type', 255)->nullable();
            $table->dateTime('announcement_datetime');
            $table->string('created_by', 255)->nullable();
            $table->longText('exam_options')->nullable();
            $table->tinyInteger('status');
            $table->unsignedBigInteger('client_id')->nullable();
            
            // optional timestamps if needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cyp_examresult');
    }
};

