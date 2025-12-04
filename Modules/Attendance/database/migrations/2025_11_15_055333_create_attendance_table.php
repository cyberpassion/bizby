<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {

            // Add all SaaS common fields
            $table->commonSaasFields();

            // Your module specific fields
            $table->date('absent_date')->nullable();

            $table->string('session', 255);
            $table->string('month', 255);
            $table->string('absent_date_part', 255);

            $table->float('absent_duration');

            $table->string('absentee_type', 255)->nullable();
            $table->string('absentee_id', 255);

            $table->string('absent_code', 255)->nullable();
            $table->string('absent_reason', 255)->nullable();

            $table->tinyInteger('is_paid')->nullable();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
