<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_optional_fees', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('fee_head_id');

            $table->string('academic_year', 20);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Foreign keys
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('fee_head_id')->references('id')->on('student_fee_heads')->onDelete('cascade');

            // Unique constraint
            $table->unique(['student_id', 'fee_head_id', 'academic_year'], 'unique_optional_fee');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_optional_fees');
    }
};
