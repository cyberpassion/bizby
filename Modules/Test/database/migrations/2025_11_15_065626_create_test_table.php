<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_test', function (Blueprint $table) {

            // Primary Key
            $table->id('test_id');

            // SaaS common fields
            $table->commonSaasFields();

            // Test Details
            $table->string('test_package', 255)->nullable();
            $table->string('test_set', 255)->nullable();
            $table->string('test_name', 255)->nullable();
            $table->text('test_language')->nullable();
            $table->string('session', 255)->nullable();
            $table->text('recipient')->nullable();
            $table->string('test_format', 255)->nullable();
            $table->text('test_structure')->nullable();
            $table->text('test_marking_format')->nullable();
            $table->string('question_source', 255)->nullable();
            $table->smallInteger('question_count')->nullable();
            $table->date('test_date')->nullable();
            $table->string('total_time', 255)->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('is_strict_timing', 255)->nullable();
            $table->unsignedTinyInteger('max_attempts_allowed')->nullable();
            $table->string('test_interface', 255)->nullable();
            $table->longText('instructions')->nullable();
            $table->text('instructions_translated')->nullable();

            // Created By / For
            $table->unsignedBigInteger('created_by')->nullable();
            $table->longText('created_for')->nullable();

            // Test Responses
            $table->longText('response')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_test');
    }
};


