<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cyp_test', function (Blueprint $table) {
            $table->unsignedBigInteger('test_id', true); // Primary Key, auto-increment
            $table->string('test_package', 255)->nullable();
            $table->string('test_set', 255)->nullable();
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->string('test_name', 255)->nullable();
            $table->text('test_language');
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
            $table->string('is_strict_timing', 255);
            $table->unsignedTinyInteger('max_attempts_allowed')->nullable();
            $table->string('test_interface', 255)->nullable();
            $table->longText('instructions')->nullable();
            $table->text('instructions_translated')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->longText('created_for')->nullable();
            $table->longText('response')->nullable();
            $table->tinyInteger('status');
            $table->bigInteger('client_id')->nullable();
            $table->string('package_id', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_test');
    }
};

