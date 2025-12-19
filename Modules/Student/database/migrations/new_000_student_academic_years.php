<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_academic_years', function (Blueprint $table) {
            $table->id();

            // Display name: 2025-26
            $table->string('name');

            // Logical year range
            $table->unsignedSmallInteger('start_year');
            $table->unsignedSmallInteger('end_year');

            // Actual academic cycle dates (used for fees, reports, automation)
            $table->date('start_date');
            $table->date('end_date');

            // Controls
            $table->boolean('is_active')->default(true);
            $table->boolean('is_locked')->default(false);

            // Optional description / note
            $table->string('description')->nullable();

            $table->timestamps();

            // Optional but recommended indexes
            $table->index(['start_year', 'end_year']);
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_academic_years');
    }
};
