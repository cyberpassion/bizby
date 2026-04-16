<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_batches', function (Blueprint $table) {

            $table->commonSaasFields();

            $table->string('name');
            $table->string('code')->nullable();

            $table->string('academic_year')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_batches');
    }
};