<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registration_cycles', function (Blueprint $table) {
            $table->commonSaasFields();

            $table->foreignId('registration_type_id')->constrained()->cascadeOnDelete();

            $table->string('name'); // Admission 2026-27
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_cycles');
    }
};