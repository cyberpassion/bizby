<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_examresult', function (Blueprint $table) {

            // Apply common SaaS fields (id, client_id, status, created_by, updated_by, deleted_by, timestamps, soft deletes)
            $table->commonSaasFields();

            // Exam Result Specific Fields
            $table->string('exam_session', 255);

            $table->string('exam_name', 255)->nullable();
            $table->string('exam_class', 255)->nullable();
            $table->string('exam_section', 255)->nullable();
            $table->string('exam_type', 255)->nullable();

            $table->string('examinee_id_type', 255)->nullable();

            $table->dateTime('announcement_datetime');

            $table->longText('exam_options')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_examresult');
    }
};

