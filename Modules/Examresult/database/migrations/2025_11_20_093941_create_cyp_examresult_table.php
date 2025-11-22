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
            // Common SaaS fields
            $table->commonSaasFields();

            // Exam result-specific fields
            $table->string('exam_session', 255);
            $table->string('exam_name', 255)->nullable();
            $table->string('exam_class', 255)->nullable();
            $table->string('exam_section', 255)->nullable();
            $table->string('exam_type', 255)->nullable();
            $table->string('examinee_id_type', 255)->nullable();
            $table->dateTime('announcement_datetime')->nullable();
            $table->longText('exam_options')->nullable();

            // Polymorphic creator reference
            $table->string('created_by_type', 64)->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
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


