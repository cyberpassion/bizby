<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cyp_student', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('class_id')->nullable(); // current class
            $table->string('academic_year'); // e.g. 2025-26
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cyp_student');
    }
};
